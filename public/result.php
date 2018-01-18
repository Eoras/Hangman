<div class="mx-auto mt-3">
    <img src="img/<?= $_SESSION['alert']['img'] ?>" alt="<?= $_SESSION['alert'] === 'win' ? 'IT\'S WIN' : 'GAME OVER' ?>" class="mx-auto d-block img-fluid">
</div>

<div class="row <?= $_SESSION['result'] === 'win' ? 'mt-5' : '' ?>">
    <div class="mx-auto">
            <a href="?reset" name="reset" class="btn btn-sm btn-outline-light">Try again</a>
        <a href="?changeWord" name="changeWord" class="btn btn-sm btn-outline-light">Change Word</a>
    </div>
</div>