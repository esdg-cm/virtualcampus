<link rel="stylesheet" type="text/css" href="<?= css_url('students/chatbox'); ?>" />

<div class="card p-0 m-0 border-0" id="chat-content">
    <div class="ps-container ps-theme-default ps-active-y" style="overflow-y: scroll !important;">
    </div>


    <form action="<?= site_url('students/courses/ajax_discussions/'.$id_matiere); ?>" class="publisher bt-1 border-light">
        <img class="avatar avatar-xs" src="<?= $User->getAvatar(); ?>" alt="<?= $User->getProfil(); ?>">
        <input class="publisher-input" name="message" type="text" placeholder="Entrez votre message ici" />
    <!--
        <span class="publisher-btn file-group">
            <i class="fa fa-paperclip file-browser"></i>
            <input type="file">
        </span>
        <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a>
    -->
        <button type="submit" class="publisher-btn text-info" data-abc="true"><i class="fa fa-paper-plane"></i></button>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('form.publisher').submit(function(e){
            e.preventDefault();
            var form = $(this),
                postData = {};
            form.serializeArray().forEach(function(elt){
                postData[elt.name] = elt.value;
            });
            if(postData.message.length) {
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: postData,
                }).done(function(response) {
                    if(/<error>/.test(response)) {
                        form.after('<p id="send_result" class="m-0 p-0 text-danger">API Error: '+response.replace('<error>', '')+'</p>');
                    }
                    else {
                        form.after('<p id="send_result" class="text-success">Message envoyé</p>');
                    }
                    setTimeout(function(){
                        $('p#send_result').remove();
                        form.find('input[name="message"]').val('');
                        loadMessages();
                        $('#chat-content > div.ps-container').scrollBottom();
                    }, 1000);
                });
            }
        });

        setInterval(() => {
            loadMessages();
         }, 1000);

        function loadMessages(go_bottom) {
            $.ajax({
                url:$('form.publisher').attr('action')+'/?action=show_msg',
                type: 'GET',
                cache: false,
                success: function(result) {
                    $('#chat-content > div.ps-container').empty().html(result);
                }
            });
        }
        loadMessages();
        $('#chat-content > div.ps-container').scrollBottom();
    });
</script>
