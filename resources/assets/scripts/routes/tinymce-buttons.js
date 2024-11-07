tinymce.PluginManager.add('custom_buttons', function( editor, url ) {
  editor.addButton( 'custom_buttons', {
    text: "Add Button",
    title: "Insert Button",
    onclick: function() {
      editor.windowManager.open( {
        title: 'Insert Button',
        width: 500,
        height: 300,
        body: [
        {
          type: 'textbox',
          name: 'url',
          label: 'URL'
        },
        {
          type: 'textbox',
          name: 'label',
          label: 'Link Text'
        },
        {
          type: 'checkbox',
          name: 'newtab',
          label: ' ',
          text: 'Open link in new tab',
          checked: true
        },
        {
          type: 'listbox',
          name: 'style',
          label: 'Button Style',
          'values': [
            { text: "Primary", value: "btn-primary" },
            { text: "Primary V2", value: "btn-primary v2" },
            { text: "Secondary", value: "btn-secondary" },
            { text: "CTA", value: "btn-cta" },
            { text: "Read More", value: "btn-read-more" },
          ]
        }],
        onsubmit: function( e ) {
          let $content = '<a href="' + e.data.url + '" class="btn' + (e.data.style !== 'default' ? ' ' + e.data.style : '') + '"' + (!!e.data.newtab ? ' target="_blank"' : '' ) + '>' + e.data.label + '</a>';
          editor.insertContent( $content );
        }
      });
    }
  });

  // editor.addButton( 'video_button', {
  //   text: "Add Video",
  //   title: "Insert Video",
  //   onclick: function() {
  //     editor.windowManager.open( {
  //       title: 'Insert Button',
  //       width: 500,
  //       height: 300,
  //       body: [
  //       {
  //         type: 'textbox',
  //         name: 'url',
  //         label: 'URL'
  //       }],
  //       onsubmit: function( e ) {
  //         let $url = e.data.url;

  //         var $isYouTube = ~$url.indexOf("youtu");
  //         var $isVimeo = ~$url.indexOf("vimeo");

  //         if ($isYouTube !== 0) {
  //           $videoUrlCleaned = $url.replace(
  //             /(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=))([\w\-]{10,12})\b[?=&\w]*(?!['"][^<>]*>|<\/a>)/ig, ' <iframe src="https://www.youtube.com/embed/$1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
  //         } else if ($isVimeo !== 0) {
  //           $videoUrlCleaned = $url.replace(/(?:https:\/\/)?(?:www\.)?(?:vimeo\.com)\/(.+)/g, '<iframe src="//player.vimeo.com/video/$1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>')
  //         } else {
  //           $videoUrlCleaned = $url;
  //         }

  //         editor.insertContent( $videoUrlCleaned );
  //       }
  //     });
  //   }
  // });
});