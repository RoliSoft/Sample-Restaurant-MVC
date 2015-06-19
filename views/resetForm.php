        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 form-margin">
                    <div class="page-header">
                        <h1>Account Recovery</h1>
                    </div>
<? if (isset($errmsg)): ?>
                    <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-remove"></span> <?=$errmsg?></div>
<? endif; ?>
                    <form class="form-horizontal" method="post" action="reset">
                        <div class="form-group">
                            <label for="mluser" class="col-sm-2 control-label">User</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="user" id="mluser" placeholder="Email or username" required />
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
                        <script type="text/javascript">var RecaptchaOptions = {theme : 'custom', custom_theme_widget: 'recaptcha_widget'};</script><? require_once 'libs/recaptcha/recaptchalib.php'; print recaptcha_get_html('6LepavQSAAAAAD2zVCWa5EKttk3WX5lrPtnEDx-r', null, true); ?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-5">
                                <input type="hidden" name="token" value="<?=$_SESSION['rst_csrf']?>" />
                                <button type="submit" class="btn btn-success">Send Reset</button>
                            </div>
                            <div class="col-sm-5" align="right">
                                <div class="checkbox">
                                    <label>
                                        <a href="login">Sign in</a> or <a href="register">sign up</a> instead &raquo;
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>