        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 form-margin">
                    <div class="page-header">
                        <h1><?=$title?></h1>
                    </div>
<? if ($redirect): ?>
                    <meta http-equiv="refresh" content="2; url=<?=$redirect?>">
<? endif; ?>
                    <div class="alert alert-<?=$type?>"><span class="glyphicon glyphicon-<?=$icon?>"></span> <?=$text?></div>
                    <div class="form-group">
                        <div class="col-sm-12" align="right">
                            <div class="checkbox">
                                <label>
                                    <a href="<?=$url_href?>"><?=$url_text?> &raquo;</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>