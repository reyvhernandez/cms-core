<div class="box box-primary">
    <div class="box-header with-border">
        <h3 style="color: #505b69;" class="box-title">
            {{trans('cms::permission.form.resource')}}
            <small>
                {{trans('cms::permission.form.help')}}
            </small>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ hasError('resource') }}">
                    <label class="form-label-style" for="resource">
                        {{trans('cms::permission.form.field.resource')}}
                    </label>
                    {!! form()->input('text', 'resource', null, ['id'=>'resource','class'=>'form-control','placeholder'=>trans('cms::permission.form.field.resource_placeholder')]) !!}
                    @error('resource')
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 style="color: #505b69;" class="box-title">
                            <i class="fa fa-tag"></i>
                            {{trans('cms::permission.form.attach-roles')}}
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ hasError('roles') }}">
                            @foreach($roles->chunk(2) as $chunk)
                                <fieldset>
                                    <div class="row">
                                        @foreach($chunk as $role)
                                            <div class="col-sm-6">
                                                <div class="md-checkbox">
                                                    <input type="checkbox" id="{{$role->id}}" value="{{$role->id}}"
                                                           name="roles[]"
                                                           class="md-check" {!! in_array($role->id, $permission->roles()->select('roles.id')->pluck('id')->all()) ? 'checked' : '' !!}
                                                    >
                                                    <label for="{{$role->id}}">{{$role->name}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endforeach
                            @error('permissions')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-actions">
            <a href="{{ route('administrator.permissions.index') }}" class="btn btn-warning text-bold">
                {{trans('cms::button.back')}}
            </a>
            <button type="reset" class="btn btn-default text-bold">
                {{trans('cms::button.reset')}}
            </button>
            <button type="submit" class="btn btn-primary text-bold">
                <i class="fa fa-check"></i> {{trans('cms::button.save')}}
            </button>
        </div>
    </div>
</div>
