
<div class="row disabled">
    <div class='col-md-3 col-sm-3'>
        <div class='col-md-12 col-sm-12'>
            {!! Form::text('name')
            -> label(trans('user::user.label.name'))
            -> placeholder(trans('user::user.placeholder.name')) !!}
        </div>
        <div class='col-md-12 col-sm-12'>
            {!! Form::email('email')
            -> label(trans('user::user.label.email'))
            -> placeholder(trans('user::user.placeholder.email')) !!}
        </div>
        <div class='col-md-12 col-sm-12'>
            {!! Form::password('password')
            -> label(trans('user::user.label.password'))
            -> placeholder(trans('user::user.placeholder.password')) !!}
        </div>
        <div class='col-md-12 col-sm-12'>
            {!! Form::text('designation')
            -> label(trans('user::user.label.designation'))
            -> placeholder(trans('user::user.placeholder.designation')) !!}
        </div>
        <div class='col-md-12 col-sm-12'>
            {!! Form::tel('mobile')
            -> label(trans('user::user.label.mobile'))
            -> placeholder(trans('user::user.placeholder.mobile')) !!}
        </div>        </div>
    <div  class='col-md-9 col-sm-9'>
    <div class='col-md-12 col-sm-12'>
    <strong>Roles</strong><br/>
    @foreach ($roles as $role)
        <div class="col-md-1">
            <div class="checkbox checkbox-danger" >
              <input name="roles[{{ $role->id }}]" id="roles.{{ $role->id }}" type="checkbox" {{ ( $user-> hasRole($role->name)) ? 'checked' : '' }} value='{{ $role->id }}'>
              <label for="roles.{{ $role->id }}">{{ ucfirst($role->name) }}</label>
            </div>
        </div>
    @endforeach
    </div>

    <div class='col-md-6 col-sm-12'>
    <br/> <strong>Permissions</strong><br/>
      <div class="treeview" style="height:250px;overflow:auto;">
          <ul style="margin-left:-40px;">
              @foreach($permissions as $package => $modules)
                  <li>
                  <input name="permissions[{{$package}}]" id="permissions_{{$package}}" type="checkbox" {{ @array_key_exists($package, $role->permissions) ? 'checked' : '' }} value='1'>
                  <label for="permissions_{{$package}}">{{ucfirst($package)}}</label>
                  <ul>
                  @foreach($modules as $module => $permissions)
                      <li>
                      <input name="permissions[{{$package}}.{{$module}}]" id="permissions_{{$package}}_{{$module}}" type="checkbox" {{ @array_key_exists($package. '.' . $module, $role->permissions) ? 'checked' : '' }} value='1'>
                      <label for="permissions_{{$package}}_{{$module}}">{{ucfirst($module)}}</label>
                          <ul class="clearfix">
                          @foreach($permissions as $permission => $value)
                              <li style="float:left; margin-right: 10px;">
                                  <input name="permissions[{{$package}}.{{$module}}.{{$permission}}]" id="permissions_{{$package}}_{{$module}}_{{$permission}}" type="checkbox" {{ @array_key_exists($package. '.' . $module . '.' . $permission, $role->permissions) ? 'checked' : '' }} value='1'>
                                  <label for="permissions_{{$package}}_{{$module}}_{{$permission}}">{{ucfirst($permission)}} </label>
                              </li>
                          @endforeach
                          </ul>
                      </li>
                  @endforeach
                  </ul>
                  <hr />
              </li>
          @endforeach
          </ul>
      </div>
    </div>
  </div>
</div>



<style type="text/css">

.treeview {
  margin: 10px 0 0 0px;
}
.treeview ul { 
  list-style: none;
}

.treeview li label {
    font-weight: 500;
    margin-bottom: 2px;
}
.treeview hr {
    margin-top: 2px;
}
.treeview>ul>li>label {
    font-weight: 700;
}
</style>

<script type="text/javascript">
$(function() {
    $('input[type="checkbox"]').change(function(e) {

      var checked = $(this).prop("checked"),
          container = $(this).parent(),
          siblings = container.siblings();

      container.find('input[type="checkbox"]').prop({
        indeterminate: false,
        checked: checked
      });

      function checkSiblings(el) {

        var parent = el.parent().parent(),
            all = true;

        el.siblings().each(function() {
          return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
        });

        if (all && checked) {

          parent.children('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
          });

          checkSiblings(parent);

        } else if (all && !checked) {

          parent.children('input[type="checkbox"]').prop("checked", checked);
          parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
          checkSiblings(parent);

        } else {

          el.parents("li").children('input[type="checkbox"]').prop({
            indeterminate: true,
            checked: false
          });

        }
      }
      checkSiblings(container);
    });
});
</script>