    <div class="row">
        <div class="col-md-8 col-md-offset-2">


            @include('crud::inc.grouped_errors')

            {!! Form::open(array('url' => $crud->route, 'method' => 'post', 'files'=>$crud->hasUploadFields('create'))) !!}
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('backpack::crud.add_a_new') }} {{ $crud->entity_name }}</h3>
                </div>
                <div class="box-body row">
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    @if(view()->exists('vendor.backpack.crud.form_content'))
                        @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
                    @else
                        @include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer">

                    @include('crud::inc.form_save_buttons')

                </div><!-- /.box-footer-->

            </div><!-- /.box -->
            {!! Form::close() !!}
        </div>
    </div>
