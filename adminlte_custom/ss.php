<?php
//copyright by simonchen

require 'scripts/pi-hole/php/header_authenticated.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="box" id="recent-queries">
            <div class="box-header with-border">
                <h3 class="box-title">Shadowsocks (为避免冲突，请关闭默认管理中的Shadowsocks)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
		<form action="" method="post">
		  <h4>Config file</h4>
		  <textarea name="ss_config" cols=100 rows=20></textarea>
		</form>
            </div>
        </div>
    </div>
</div>
