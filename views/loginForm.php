        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 form-margin">
                    <div class="page-header">
                        <h1>Sign In</h1>
                    </div>
<? if (isset($errmsg)): ?>
                    <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-remove"></span> <?=$errmsg?></div>
<? elseif (isset($infmsg)): ?>
                    <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-envelope"></span> <?=$infmsg?></div>
<? endif; ?>
                    <form class="form-horizontal" method="post" action="login">
                        <div class="form-group">
                            <label for="mluser" class="col-sm-2 control-label">User</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="user" id="mluser" placeholder="Email or username" value="<?=htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8')?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mlpass" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="pass" id="mlpass" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-5">
                                <div class="checkbox agree-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" checked="checked" /> Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5" align="right">
                                <div class="checkbox agree-checkbox">
                                    <label>
                                        <a href="reset"><i class="glyphicon glyphicon-envelope"></i>Reset password</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <input type="hidden" name="token" value="<?=$_SESSION['lgn_csrf']?>" />
                                <button type="submit" class="btn btn-success">Sign In</button>
                            </div>
                            <div class="col-sm-4" align="right">
                                <div class="checkbox">
                                    <label>
                                        <a href="register">Sign up instead &raquo;</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>