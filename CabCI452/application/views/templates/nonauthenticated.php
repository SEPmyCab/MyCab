
<div class="btn-group btn-header-margin" id="LoginRegisterDropdown">
               
                <button type="button" class="btn btn-info dropdown-toggle"data-toggle="dropdown" id="login-form">Login <span class="caret"></span></button>
            
            <div class="dropdown-menu pull-right loginregister">
            
                <?php 
                

                //$this->user_authentication->checkCookies();

               //$this->user_authentication->checkSession();
                
                $attributes = array('class' => 'form', 'id' => 'formLogin');
                echo form_open('user_authentication/user_login_process', $attributes);
                echo '<h4 class="form-signin-heading">Please sign in</h2>';
                echo '<label for="inputEmaillogin" class="sr-only">Email address</label>';
                  $data = array(
                    'name'=>'inputEmaillogin',
              'type'        => 'email',
              'class'       => 'form-control',
              'placeholder'   => 'Email Address',
                    'required'=>'required',
                    'autofocus'=>'autofocus'
            );
                 echo form_input($data);
                 echo '</br>';
                 echo ' <label for="inputPasswordlogin" class="sr-only">Password</label>';
                 $data1 = array(
                    'name'=>'inputPasswordlogin',
              'class'       => 'form-control',
              'placeholder'   => 'Password',
                    'required'=>'required'
            );
                 echo form_password($data1);
                 echo '<br/>';
                ?>
               
         <!-- <a href="<?//php echo site_url('user_authentication/forgot_pwd_show')?>">Forgot Password</a>-->
        <div class="checkbox">
          <label>
            <!--  <input type="checkbox" value="remember-me" name="remember">Remember me-->
          </label>
        </div>
              <?php 
              if(isset($_POST['remember'])) {
        
        $user->setCookies($_POST['inputEmail']);
    }
              $attributes1 = array('class' => 'btn btn-default btn-primary btn-block', 'type' => 'submit');
              echo form_button($attributes1,'Log in');
              echo form_close();
              ?>
            
              </form>
            </div>
           
           <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle"data-toggle="dropdown"id="register-form"aria-expanded="false">Register <span class="caret"></span></button>
             <div class="dropdown-menu pull-right loginregister">
             
                  <?php 
                $attributes2 = array('class' => 'form', 'id' => 'formRegister');
                echo form_open('user_authentication/new_user_registration', $attributes2);
                echo '<h4 class="form-signin-heading">Please Register</h2>';
                echo '<label for="inputEmail" class="sr-only">Email address</label>';
                 $data2 = array(
                    'name'=>'inputEmail',
              'type'        => 'email',
              'id'          => 'inputEmail',
              'class'       => 'form-control',
              'placeholder'   => 'Email Address',
                     'required' => 'required'
                     
            );
                 echo form_input($data2);
                 echo '</br>';
                 echo ' <label for="inputPassword" class="sr-only">Password</label>';
                 $data3 = array(
                    'name'=>'inputPassword',
              'id'          => 'inputPassword',
              'class'       => 'form-control',
              'placeholder'   => 'Password',
                    'required' => 'required'
            );
                 echo form_password($data3);
                 echo '<br/>';
                 echo ' <label for="inputPasswordCon" class="sr-only">Confirm Password</label>';
                 $data4 = array(
                    'name'=>'inputPasswordCon',
              'id'          => 'inputPasswordCon',
              'class'       => 'form-control',
              'placeholder'   => 'Confirm Password',
                    'required' => 'required',
            );
                 echo form_password($data4);
                  echo '<br/>';
                   $attributes3 = array('class' => 'btn btn-default btn-primary btn-block', 'type' => 'submit');
              echo form_button($attributes3,'Register');
              echo form_close();
                ?>
              </form>
            </div>
           </div>
             </div>



