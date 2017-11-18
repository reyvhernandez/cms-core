<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title font-s14">Category Blog Parameters</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <label class="form-label-style col-md-3">Choose a Category</label>

            <div class="input-control col-md-9">
                {!! form()->categories('parameters[id]', null, ['id' => 'select-category', 'class' => 'select2 form-control']) !!}
            </div>
        </div>

        <div class="row {{ hasError('url') }}" style="margin-top: 10px;">
            <label class="form-label-style col-md-3" for="url">
                URL
                @tooltip('Link for this menu.')
            </label>

            <div class="input-control col-md-9">
                <div class="input-group">
                    <span class="input-group-addon site-label">{{ url('/') }}/</span>
                    {!! form()->input('text', 'url', null, ['id'=>'url','class'=>'form-control','placeholder'=>'URL','readonly']) !!}
                </div>
                @error('url')
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#select-category').on('change', function() {
            var slug = $(this).find(':selected').data('alias');
            $('#url').val(slug.toLowerCase());
        }).select2().change();
    });
</script>
