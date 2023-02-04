<?php
//copyright by simonchen

require 'scripts/pi-hole/php/header_authenticated.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="box" id="recent-queries">
            <div class="box-header with-border">
                <h3 class="box-title">Shellinabox - 网页终端</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
		<iframe src="<?php echo "http://".$_SERVER['SERVER_ADDR'].":4200" ?>" width="100%" height="400" border="0"></iframe>
            </div>
        </div>
    </div>
</div>
