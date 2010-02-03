YUI().use('dd-drop', 'dd-constrain', 'io-base',function(Y) {
  var thumbs = Y.one('#thumbs');
  var preview = Y.one('#preview');
  var content = Y.one('#content');
  Y.one('body').addClass('js');
  Y.one('#collect').append('<ul id="collection"></ul><div id="trash"></div>'+
                           '<span class="head">Drag to collect</span>'+
                           '<button id="seeall">See all code</button>');
  Y.one('#intro p').append('You can drag photos into the collection below '+
                           'the thumbnails and remove them from the bin by '+
                           'dragging them into the removal box. '+
                           'Once you are done, hit the "See all code"'+
                           ' button to get the HTML of all the photos in '+
                           'your collection box.');
  var trash = Y.one('#trash');
  trash.append('<span class="head">Drag to remove</span>');
  var collection = Y.one('#collection');
  function add_drags(){
    var drags = Y.Node.all('#thumbs li');
    drags.each(function(v, k, items) {
      items.item(k).append('<span>drag me!</span>');
      var dd = new Y.DD.Drag({
          node: items.item(k),
          handle: items.item(k).all('span')
      });
    });
  }

  var drop = new Y.DD.Drop({node:collection});
  var trashdrop = new Y.DD.Drop({node:trash});
  add_drags();
  trashdrop.on('drop:hit', function(e) {
    var drag = e.drag;
    var item = drag.get('node').remove();
  });
  drop.on('drop:hit', function(e) {
    var drag = e.drag;
    var item = drag.get('node');
    item.removeAttribute('style');
    collection.appendChild(item);
  });
  var loadthumbs = {
    on:{
      start:function(id,o,args){
        thumbs.setStyle('opacity',.2);
      },
      complete:function(id,o,args){
        thumbs.set('innerHTML',o.responseText);
        thumbs.setStyle('opacity',1);
        add_drags();
      }
    }
  }
  var previewxhr = {
    on:{
      start:function(id,o,args){
        preview.setStyle('opacity',.2);
      },
      complete:function(id,o,args){
        preview.setStyle('opacity',1);
        preview.set('innerHTML',o.responseText);
        var t = Y.one('#preview a');
        t.focus();
      }
    }
  }
  thumbs.delegate('click',function(e){
    e.preventDefault();
    if(this.hasClass('more')){
      var uri = this.getAttribute('href').replace('index','thumbs');
      var request = Y.io(uri,loadthumbs);
    } else {
      var uri = this.getAttribute('href').split('id=')[1];
      var request = Y.io('fullview.php?id='+uri,previewxhr);
    }
  },'a');
  collection.delegate('click',function(e){
    e.preventDefault();
    var uri = this.getAttribute('href').split('id=')[1];
    var request = Y.io('fullview.php?id='+uri,previewxhr);
  },'a');
  Y.one('#seeall').on('click',function(e){
    e.preventDefault();
    var thumbs = collection.all('a');
    var ids = [];
    thumbs.each(function(v, k, items){
      ids.push(items.item(k).get('href').split('id=')[1]);
    });
    if(ids.length>0){
      var request = Y.io('fullcode.php?ids='+ids.join(','),
        {on:{
          start:function(id,o,args){
            preview.setStyle('opacity',.1);
          },
          complete:function(id,o,args){
            preview.setStyle('opacity',1);
            preview.set('innerHTML',o.responseText);
            var t = Y.one('#preview textarea');
            t.set('tabIndex',-1);
            t.focus();
          }
        }
      });
    }
  },'button');
  Y.on("submit", function(e){
    e.preventDefault();
    var what = Y.one('#what').get('value');
    Y.io('thumbs.php?what='+what,loadthumbs);
  }, "#mainform");
});
