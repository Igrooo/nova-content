$(document).ready(function(){
    
    function banreset(){
        $('#image-header').removeAttr('style');
        $('#userban').val('no').attr('value','no')
        $('#cover, #contain').attr('disabled', 'disabled');
        $('#dropzone').addClass('empty').show();
        $('#ban, #baninfo').show();
        $('#banok').hide();
        $('#banname').text('');
        $('#ban, #dropzone-input').removeProp('files').val(null);
        
         if ( $('#custom-tools, #step3').is(':target') ) {
            $('#dropzone-input').show();
            $('#dropzoneinfo').css('display','block');
         }
    }
    
    banreset();
    /* Text counter */
    function counter(val){
        var textinfo = $('#textinfo');
        var textlenght = val.length;if (textlenght == 0){ textinfo.empty(); }
        else if(textlenght <= 1000 ){ var textremaining = 1000 - textlenght;textinfo.text( +textremaining+' caractère(s) restant(s)'); }
        else{ var tootext = textlenght - 1000;textinfo.text( tootext+' caractère(s) en éxcès'); }
    }
    
    /* Forms elements and dynamic update html */
    function switch_input(input, target, value, opposite_value){
        $(input).addClass('select');
        $('#'+opposite_value).removeClass();
        $('#'+target).val(value).attr('value',value);
    }
    function update_input_file(input){
        input = $(input);
        $('#userban').val('yes').attr('value','yes')
        $('#cover, #contain').removeAttr('disabled');
        val = input.val();
        $('#banname').text(val);
    }
    function update_colors(input, type, target){
        hexa = $(input).val();
        $(target).val(hexa);
        $('header').css(type+'color', hexa);
    }
    function update_text(input, target, default_value){
        val = $.trim($(input).val());
        if((val.lenght != 0)||(val != '')){
            console.log('textvalue : '+val);
            $(target).text(val);
        }
        else{
            console.log('textvalue : '+val);
            $(target).text(default_value);
        }
    }
    function update_textarea(input, target){
        val = $.trim($(input).val());
        counter(val);
        $(target).html(val.replace(/\r\n|\r|\n/g,'<br>')); 
    }   
    function update_explorer_theme(input, value, opposite_value){
        switch_input(input, 'explorer-theme', value, opposite_value);
        $('#explorer-header, #explorer-body').removeClass(opposite_value+'-theme').addClass(value+'-theme');
    }
    function update_size_ban(input, value, opposite_value){
        switch_input(input, 'size', value, opposite_value);
        $('#image-header').css('background-size', value );
    }
    
    /* File Reader API and dynamic update banner*/
    function handleFileSelect(input){
        input = $(input);
        if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
          console.log('The File APIs are not fully supported in this browser.');
          return;
        }
        if (!input) {
          console.log('Um, couldn\'t find the fileinput element.');
        }
        else if (!input.prop('files')) {
          console.log('This browser doesn\'t seem to support the `files` property of file inputs.');
        }
        else if (!input.prop('files')[0]) {
          console.log('Please select a file before clicking `Load`');               
        }
        else {
          file = input.prop('files')[0];
          fr = new FileReader();
          fr.onloadstart = loader;
          fr.onload = update_banner;
          fr.readAsDataURL(file);
        }
    }

    function loader(){
        $('#dropzone').addClass('load');
    }
    function update_banner() {
        img = fr.result;
        console.log(img);
        $('#image-header').css('height','200').css('background-image', 'url('+img+')').css('background-repeat','no-repeat').css('background-size', 'cover');
        $('#dropzone').removeClass('load').removeClass('empty').hide();
        $('#ban, #baninfo').hide();
        $('#banok').show();
    }

    
    /*User Actions*/

    $('#discover:not(.disabled)').click(function(){
        $('#custom-tools .welcome, #custom-tools .choice').hide();
        $('#biglogo').css('height', 100);
    });
    $('#advance, #step2 .next').click(function(){
        $('#dropzone-input').show();
        $('#dropzoneinfo').css('display','block');
    });
    $('#advance').click(function(){
        $('#step1').focus();
    });

    $('#title-input').keyup(function()          { update_text(this, '#title', 'CosmicBox');                        });
    $('#explorer-item-input').keyup(function()  { update_text(this, '#explorer-item', 'Explorateur de fichiers');  });
    $('#title-input').change(function()         { update_text(this, '#title', 'CosmicBox');                        });
    $('#explorer-item-input').change(function() { update_text(this, '#explorer-item', 'Explorateur de fichiers');  });

    $('#background').change(function()          { update_colors(this, 'background-', '#hexa-background');     });
    $('#hexa-background').change(function()     { update_colors(this, 'background-', '#background');          });
    $('#font').change(function()                { update_colors(this, '',            '#hexa-font');           });
    $('#hexa-font').change(function()           { update_colors(this, '',            '#font');                });
    $('#background').keyup(function()           { update_colors(this, 'background-', '#hexa-background');     });
    $('#hexa-background').keyup(function()      { update_colors(this, 'background-', '#background');          });
    $('#font').keyup(function()                 { update_colors(this, '',            '#hexa-font');           });
    $('#hexa-font').keyup(function()            { update_colors(this, '',            '#font');                });
    $('#background').focusout(function()        { update_colors(this, 'background-', '#hexa-background');     });
    $('#hexa-background').focusout(function()   { update_colors(this, 'background-', '#background');          });
    $('#font').focusout(function()              { update_colors(this, '',            '#hexa-font');           });
    $('#hexa-font').focusout(function()         { update_colors(this, '',            '#font');                });

    $('#welcome-title-input').keyup(function()  { update_text(this,     '#welcome-title', '');  });
    $('#welcome-text-input').keyup(function()   { update_textarea(this, '#welcome-text');       });
    $('#welcome-title-input').change(function() { update_text(this,     '#welcome-title', '');  });
    $('#welcome-text-input').change(function()  { update_textarea(this, '#welcome-text');       });
    
    $('#ban').change(function()                 { handleFileSelect('#ban'); update_input_file('#ban'); });
    $('#dropzone-input').change(function()      { handleFileSelect('#dropzone-input'); update_input_file('#dropzone-input');});
    
    $('#dropzone-input').bind('dragenter',function(){ $('#dropzone').addClass('hover');     });
    $('#dropzone-input').bind('dragleave',function(){ $('#dropzone').removeClass('hover');  });
    
    $('#banreset').click(function()             { banreset(); });
    
    $('#cover').click(function()                { update_size_ban(this, 'cover','contain'); });
    $('#contain').click(function()              { update_size_ban(this, 'contain','cover'); });
    
    $('#dark').click(function()                 { update_explorer_theme(this, 'dark', 'light'); });
    $('#light').click(function()                { update_explorer_theme(this, 'light', 'dark'); });
    
});
