(function(){
        $('.btn-delete').on('click',function(){
            var newsId = $(this).data('newsid');
            var operation = 'delete';
            var postData = {};
            postData.newsID = newsId;
            postData.operation = operation;
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : '../process_news.php', //Your form processing file URL
                data      : postData, //Forms name
                success   : function(data) {
                    window.location.reload();
                }
            });
            event.preventDefault(); //Prevent the default submit
        });
    })();