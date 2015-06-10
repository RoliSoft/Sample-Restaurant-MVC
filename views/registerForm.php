		<div class="container">
			<div class="row">
				<div class="col-lg-offset-3 col-lg-6 form-margin">
					<div class="page-header">
						<h1>Sign Up</h1>
					</div>
<? if (isset($errmsg)): ?>
					<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-remove"></span> <?=$errmsg?></div>
<? elseif (isset($infmsg)): ?>
					<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-arrow-right"></span> <?=$infmsg?></div>
<? endif; ?>
					<form class="form-horizontal" method="post" action="register">
						<div class="form-group">
							<label for="rluser" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="user" id="rluser" placeholder="Username" value="<?=htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8')?>" required />
							</div>
						</div>
						<div class="form-group">
							<label for="rlmail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="mail" id="rlmail" placeholder="Email" value="<?=htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8')?>" required />
							</div>
						</div>
						<div class="form-group">
							<label for="rlpass" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="pass" id="rlpass" placeholder="Password" required />
								<input type="password" class="form-control" name="pazz" id="rlpazz" placeholder="Confirm password" required />
							</div>
						</div>
						<div id="recaptcha_widget" style="display: none;">
							<div class="form-group">
								<label for="recaptcha_response_field" class="col-sm-2 control-label">Captcha</label>
								<div class="col-sm-10" style="min-height: 67px;">
									<div style="display: inline-block; padding: 4px; background-color: #fff; border: 1px solid #ddd; border-radius: 0;"><div id="recaptcha_image">&nbsp;</div></div>
								</div>
							</div>
							<div class="form-group">
								<label for="recaptcha_response_field" class="col-sm-2 control-label">&nbsp;</label>
								<div class="col-sm-10">
									<div class="right">
										<a class="btn btn-default" href="javascript:Recaptcha.reload()" title="Get a new captcha"><i class="glyphicon glyphicon-refresh"></i></a>
										<a class="btn btn-default recaptcha_only_if_image" href="javascript:Recaptcha.switch_type('audio')" title="Get an audio captcha"><i class="glyphicon glyphicon-headphones"></i></a>
										<a class="btn btn-default recaptcha_only_if_audio" href="javascript:Recaptcha.switch_type('image')" title="Get an image captcha"><i class="glyphicon glyphicon-picture"></i></a>
										<a class="btn btn-default" href="javascript:Recaptcha.showhelp()" title="About reCaptcha"><i class="glyphicon glyphicon-question-sign"></i></a>
									</div>
									<input type="text" class="form-control input-recaptcha" id="recaptcha_response_field" name="recaptcha_response_field" style="display: inline-block; width: 263px;" required />
								</div>
							</div>
						</div>
						<script type="text/javascript">var RecaptchaOptions = {theme : 'custom', custom_theme_widget: 'recaptcha_widget'};</script><? require_once 'libs/recaptcha/recaptchalib.php'; print recaptcha_get_html('6LepavQSAAAAAD2zVCWa5EKttk3WX5lrPtnEDx-r'); ?>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox agree-checkbox">
									<label>
										<input type="checkbox" name="agree"<?=($_POST['agree']=='on'?' checked="checked"':'')?> /> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-5">
								<input type="hidden" name="token" value="<?=$_SESSION['reg_csrf']?>" />
								<button type="submit" class="btn btn-success">Sign Up</button>
							</div>
							<div class="col-sm-5" align="right">
								<div class="checkbox">
									<label>
										<a href="login">Sign in instead &raquo;</a>
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>