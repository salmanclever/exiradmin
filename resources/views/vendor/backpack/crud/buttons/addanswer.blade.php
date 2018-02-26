@if ($crud->hasAccess('update'))
    @if (!$crud->model->translationEnabled())

        <!-- Single edit button -->
        <a href="{{ url($crud->route.'/'.$entry->getKey().'/addanswer') }}" class="btn btn-xs btn-default btn-answer"><i class="fa  fa-question"></i> {{ trans('backpack::crud.add_answer') }}</a>

    @else

        <!-- Edit button group -->
        <div class="btn-group">
            <a href="{{ url($crud->route.'/'.$entry->getKey().'/addanswer') }}" class="btn btn-xs btn-default"><i class="fa fa-question"></i> {{ trans('backpack::crud.add_answer') }}</a>
            <button type="button" class="btn btn-xs btn-default dropdown-toggle btn-answer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">{{ trans('backpack::crud.add_answer') }}:</li>
                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                    <li><a href="{{ url($crud->route.'/'.$entry->getKey().'/addanswer') }}?locale={{ $key }}">{{ $locale }}</a></li>
                @endforeach
            </ul>
        </div>

    @endif
@endif

<script>


        var minanswer = 1;
        var maxanswer = 10;
        var answerqty = 1;

        var answermodal = new tingle.modal({
            footer: false,
            stickyFooter: false,
            closeMethods: ['overlay', 'button', 'escape'],
            closeLabel: "Close",
            cssClass: ['custom-class-1', 'custom-class-2'],
            onOpen: function() {
                minanswer = $('.addel-target').attr('answer-qty');
                $('.addel').addel({
                    classes: {

                        target: 'addel-target',
                        add: 'addel-add',
                        delete: 'addel-delete',
                        deleting: pluginName + '-deleting'
                    },

                }).on('addel:delete', function (event) {




                    if(minanswer > 1){

                        if (window.confirm('از حذف ' + '"' + event.target.find(':text').val() + '"مطمعنی؟')) {
                            $.ajax({
                                type: "DELETE",
                                url:$('.btn-answer').attr('href'),
                                dataType:'json',
                                async: false,
                                data: { answer: event.target.find(':text').attr('answer-id') },
                                success: function(result){
                                    var res = JSON.parse(result);
                                    minanswer--;
                                    console.log(res);
                                },
                                error: function (request, status, error) {
                                    console.log(request.responseText);
                                    event.preventDefault();
                                }

                            });

                        }else{
                            event.preventDefault();
                        }

                    }else{
                            if (window.confirm('از حذف ' + '"' + event.target.find(':text').val() + '"مطمعنی؟')) {
                                $.ajax({
                                    type: "DELETE",
                                    url:$('.btn-answer').attr('href'),
                                    async: false,
                                    dataType:'json',
                                    data: { answer: event.target.find(':text').attr('answer-id') },
                                    success: function(result){
                                        var res = JSON.parse(result);
                                        console.log(res);
                                    },
                                    error: function (request, status, error) {
                                        event.preventDefault();
                                        console.log(request.responseText);
                                    }
                                });
                                event.target.find(':text').val("");
                                event.preventDefault();
                            }else {
                                event.preventDefault();
                            }


                        }


                }).on('addel:add', function (event) {


                    $.ajax({
                        method: "POST",
                        url:$('.btn-answer').attr('href'),
                        dataType: 'text',
                        async: false,
                        data: { answer: event.target.find(':text').val() },
                        success: function(result){
                            var res = JSON.parse(result);
                            event.target.find(':text').attr('answer-id',res.id);
                            event.target.children('div .input-group-btn').children('.btn-success').fadeOut();
                        },
                        error: function (request, status, error) {
                            event.preventDefault();
                            console.log(request.responseText);
                        }
                    });

                    minanswer++;
                });
            },
            onClose: function() {
                console.log('modal closed');
            },
            beforeClose: function() {
                // here's goes some logic
                // e.g. save content before closing the modal

                return true; // close the modal

            }
        });

        answermodal.setContent(' <img src="{{ asset('vendor/backpack/crud/img/103.gif') }}" alt="">');

        answermodal.checkOverflow();

        $('.btn-answer').click(function (e) {
            e.preventDefault();
            $.ajax({
                url:$(this).attr('href'),
                dataType:'html',
                success: function (data) {
                    answermodal.open();
                    answermodal.setContent(data);
                }
            });
        });






</script>