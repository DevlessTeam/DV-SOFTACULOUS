@include('header')
    <style media="screen">
        @media screen and (min-width: 768px) {
            #imgtop {
                position: fixed;
                left: 0;
            }

            section .panel {
                top: 50px;
            }
        }

        @media screen and (min-width: 768px) and (max-width: 991px) {
            section .panel {
                top: 50px;
            }
        }

        @media screen and (min-width: 993px) and (max-width: 1199px) {
            section .panel {
                left: -200px;
            }
        }
    </style>
  <section>
    @include('error')

    <!--body wrapper start-->
    <div class="wrapper">
      <div class="row">
        <a href="https://devless.io">
          <img src="{{Request::secure(Request::root()).'/img/logo.png'}}" class="setup-logo" alt="Devless">
        </a>
        <div class="col-lg-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
          <section class="panel">
            <header class="panel-heading">
              DB & App Setup
            </header>
            <div class="panel-body">
              <form action="{{ url('/install') }}" class="form-horizontal" method="POST">
                <div class="form-group @if($errors->has('db_name')) has-error @endif">
                    <label for="db_name" class="col-lg-2 control-label">DB Name</label>
                    <div class="col-lg-10">
                      <input type="text" id="db_name-field" name="db_name" class="form-control" required="">
                         @if($errors->has("db_name"))
                            <span class="help-block">{{ $errors->first("db_name") }}</span>
                         @endif
                    </div>
                </div>
                <div class="form-group @if($errors->has('db_user')) has-error @endif" >
                  <label for="db_user" class="col-lg-2 control-label">DB User</label>
                  <div class="col-lg-10">
                    <input type="text" id="db_user-field" name="db_user" class="form-control" required="">
                    @if($errors->has("db_user"))
                      <span class="help-block">{{ $errors->first("db_user") }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group @if($errors->has('db_pass')) has-error @endif" >
                  <label for="db_pass" class="col-lg-2 control-label">DB Pass</label>
                  <div class="col-lg-10">
                    <input type="text" id="db_pass-field" name="db_pass" class="form-control" required="">
                    @if($errors->has("db_pass"))
                      <span class="help-block">{{ $errors->first("db_pass") }}</span>
                    @endif
                  </div>
                </div>

                <hr>

                <div class="form-group @if($errors->has('email')) has-error @endif" >
                  <label for="email" class="col-lg-2 control-label">Email</label>
                  <div class="col-lg-10">
                    <input type="email" id="email-field" name="email" class="form-control" required="">
                    @if($errors->has("email"))
                      <span class="help-block">{{ $errors->first("email") }}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group @if($errors->has('password')) has-error @endif">
                  <label for="password" class="col-lg-2 control-label"  >Password</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" name="password" required="">
                    @if($errors->has("password"))
                      <span class="help-block">{{ $errors->first("password") }}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
                  <label for="password_confirmation" class="col-lg-2 control-label"  >Confirm Password</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" name="password_confirmation" required="">
                    @if($errors->has("password_confirmation"))
                      <span class="help-block">{{ $errors->first("password_confirmation") }}</span>
                    @endif
                  </div>
                </div>


                    <input type="hidden" id="app_name-field" name="app_name" class="form-control" required="" value="My Backend">

                    <input type="hidden" id="app_token-field" name="app_token" class="form-control" readonly="" value="{{$app['app_token']}}">


                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-info pull-right">Create App</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
