@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.trainer.actions.edit', ['name' => $trainer->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <trainer-form
                :action="'{{ $trainer->resource_url }}'"
                :data="{{ $trainer->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.trainer.actions.edit', ['name' => $trainer->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.trainer.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </trainer-form>

        </div>
    
</div>

@endsection