<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">پاسخ های این نظر سنجی</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->




    <form role="form" class="addel" ">


            @foreach($pollAnswer as $answer)

            <div class="input-group input-group-lg addel-target" answer-qty="{{$pollAnswerCount}}">
                <div class="input-group-btn">
                    <button type="button"  class="btn btn-danger addel-delete"><div class="icon glyphicon glyphicon-remove"></div></button>
                </div>
                <!-- /btn-group -->
                <input class="form-control" type="text" answer-id="{{ $answer->id }}" value="{{ $answer->answer }}">
            </div>
            @endforeach




        <div class="input-group input-group-lg addel-target">

            <div class="input-group-btn">
                <button type="button"  class="btn btn-danger addel-delete"><div class="icon glyphicon glyphicon-remove"></div></button>
                <button type="button"  class="btn btn-success addel-add"><div class="icon glyphicon glyphicon-ok"></div></button>
            </div>


            <!-- /btn-group -->
            <input class="form-control" type="text" answer-id="">
        </div>


        <style>
            .input-group{
                margin-bottom: 10px;
            }

        </style>


    </form>
</div>