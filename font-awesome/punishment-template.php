<?php
    function exc_reopen_button($_TIPS_ID) {
?>
                        <li class="<?= $class ?>">
                            <div class="exc-header">
                                <form method="POST">
                                    <span class="exc-name"><button name="mode" value="reopen" class="btn btn-success">
                                        <i class="fa fa-gavel" aria-hidden="true"></i> 再オープンする</button>
                                    </span>
                                </form>
                                <span class="exc-data">@<?= $_TIPS_ID ?></span>
                            </div>
                            <div class="exc-message">
                                異議申し立てを再開するには、上の「再オープンする」ボタンをクリックしてください。
                            </div>
                        </li>

<?php
    }

    function exc_reopen_message($_TIPS_ID, $_DATE, $_ID) {
?>

                        <li id="di-<?= $_ID ?>">
                            <div class="exc-header">
                                <span class="exc-name text-success">
                                    <i class="fa fa-ticket" aria-hidden="true"></i> 再オープン
                                </span>
                                <span class="exc-data">@<?= $_TIPS_ID ?></span>
                            </div>
                            <div class="exc-message">
                                異議申し立てが再オープンされました。
                            </div>
                            <div class="exc-footer">
                                <span class="exc-data"><?= $_DATE ?> / <a href="#di-<?= $_ID ?>"><i class="fa fa-link" aria-hidden="true"></i> <?= $_ID ?></a></span>
                            </div>
                        </li>

<?php
    }

    function exc_close_message($_TIPS_ID, $_DATE, $_ID) {
?>
                        <li class="<?= $class ?>" id="di-<?= $_ID ?>">
                            <div class="exc-header">
                                <span class="exc-name text-danger">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i> クローズ
                                </span>
                                <span class="exc-data">@<?= $_TIPS_ID ?></span>
                            </div>
                            <div class="exc-message">
                                この異議申し立ては、既にクローズされています。<br />
                                再オープンしない限り、これ以降の返信はできません。
                            </div>
                            <div class="exc-footer">
                                <span class="exc-data"><?= $_DATE ?> / <a href="#di-<?= $_ID ?>"><i class="fa fa-link" aria-hidden="true"></i> <?= $_ID ?></a></span>
                            </div>
                        </li>

<?php
    }

    function exc_open_message($_TIPS_ID, $_DATE, $_ID) {
?>

                        <li class="my-message" id="di-<?= $_ID ?>">
                            <div class="exc-header">
                                <span class="exc-name text-info">
                                    <i class="fa fa-gavel" aria-hidden="true"></i> オープン
                                </span>
                                <span class="exc-data">@<?= $_TIPS_ID ?></span>
                            </div>
                            <div class="exc-message">
                                異議申し立てが開始されました。
                            </div>
                            <div class="exc-footer">
                                <span class="exc-data"><?= $_DATE ?> / <a href="#di-<?= $_ID ?>"><i class="fa fa-link" aria-hidden="true"></i> <?= $_ID ?></a></span>
                            </div>
                        </li>

<?php
    }

    function exc_open_button($_TIPS_ID) {
        if($_MYMESSAGE) $class = "my-message"; else $class = "";
?>
                        <li class="<?= $class ?>">
                            <div class="exc-header">
                                <form method="POST">
                                    <span class="exc-name"><button name="mode" value="open" class="btn btn-info">
                                        <i class="fa fa-gavel" aria-hidden="true"></i> 異議申し立てを開始する</button>
                                    </span>
                                </form>
                                <span class="exc-data">@<?= $_TIPS_ID ?></span>
                            </div>
                            <div class="exc-message">
                                異議申し立てを開始するには、上の「異議申し立てを開始する」ボタンをクリックしてください。
                            </div>
                        </li>

<?php
    }

    function exc_notfound() {
?>
                        <li>
                            <div class="exc-header">
                                <span class="exc-name text-info">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> 未開始の異議申し立て
                                </span>
                            </div>
                            <div class="exc-message">
                                異議申し立てがされていません。
                            </div>
                        </li>

<?php
    }

    function exc_message($_MYMESSAGE, $_LEGACY, $_MC_ID, $_TIPS_ID, $_LABEL, $_MESSAGE, $_DATE, $_ID) {
        if($_MYMESSAGE) $class = "my-message"; else $class = "";
        if(!$_LEGACY) {
            switch($_LABEL) {
                case "disposer": $team = "被処罰者"; break;
                case "tipser": $team = "T!PS 運営チーム"; break;
                case "staff": $team = "サーバスタッフ"; break;
            }
        }
?>
                        <li class="<?= $class ?>" id="di-<?= $_ID ?>">
                            <div class="exc-header">
                                <span class="exc-name">
<?php
    if(!$_LEGACY) {
?>
                                    <img src="https://minotar.net/avatar/<?= $_MC_ID ?>" height="32px"> 
<?php
    } else {
?>
                                    <i class="fa fa-user" aria-hidden="true"></i> 
<?php
    }
?>
                                    <?= $_MC_ID ?>
                                </span>
<?php
    if(!$_LEGACY) {
?>
                                <span class="exc-data"><span class="label label-<?= $_LABEL ?>"><?= $team ?></span></span>
                                <span class="exc-data">@<?= $_TIPS_ID ?></span>
<?php
    }
?>
                            </div>
                            <div class="exc-message">
                                <?= $_MESSAGE ?>
                            </div>
                            <div class="exc-footer">
                                <span class="exc-data"><?= $_DATE ?> / <a href="#di-<?= $_ID ?>"><i class="fa fa-link" aria-hidden="true"></i> <?= $_ID ?></a></span>
                            </div>
                        </li>

<?php
    }

    function exc_send_message($_MC_ID, $_TIPS_ID) {
?>
                        <li>
                            <div class="exc-header">
                                <span class="exc-name">
                                    <img src="https://minotar.net/avatar/<?= $_MC_ID ?>" height="32px"> <?= $_MC_ID ?>
                                </span>
                                <span class="exc-data">@<?= $_TIPS_ID ?></span>
                            </div>
                            <form method="POST">
                                <textarea class="form-control margin-top" name="message" rows="3" id="textArea"></textarea>
                                <span class="help-block">改行はそのまま改行できます。</span>
                                <div class="form-group">
                                </div>
                                <div class="exc-footer">
                                    <button type="submit" name="sendclose" class="btn btn-default">送信してクローズ</button> 
                                    <button type="submit" name="send" class="btn btn-success">送信</button>
                                </div>
                            </form>
                        </li>

<?php
    }