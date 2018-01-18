<h1 class="text-center pt-2 title builtWord"><?= $builtWord ?></h1>
<p class="text-right mt-5 pr-3 pb-0 mb-0">
    <small>Errors: <?= $_SESSION['errors'] ?> / 6</small>

    <!-- USED LETTERS-->
    <span class="float-left" <?= count($_SESSION['try']) <= 0 ? 'hidden' : '' ?>>
        <strong>Used letters:
            <span class="text-info">
                <?= implode(" - ", $_SESSION['try']) ?>
            </span>
        </strong>
    </span>
<div class="clearfix"></div>
</p>

<hr class="pb-2 pt-1 mt-1">

<div class="alert alert-<?= key($_SESSION['alert']) ?? 'light' ?> " role="alert">
    <?= $_SESSION['alert'][key($_SESSION['alert'])] ?? "Send me a letter :D I will check if it's in the word ..." ?>
    <?php $_SESSION['alert'] = []; ?>
</div>

<form action="" method="POST">
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" id="letter" name="letter" placeholder="Your letter"
                   autofocus>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-info btn-block" name="try">SEND</button>
                </div>
                <div class="col-md-4" <?= count($_SESSION['try']) <= 0 ? 'hidden' : '' ?>>
                    <a href="?reset" name="reset" class="btn btn-block btn-outline-light">Reset</a>
                </div>
            </div>

        </div>
    </div>
</form>