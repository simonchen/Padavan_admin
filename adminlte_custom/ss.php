<?php
/*
*    Pi-hole: A black hole for Internet advertisements
*    (c) 2019 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license.
*/

require 'scripts/pi-hole/php/header_authenticated.php';

$nvram = read_nvram();

?>

<script type="text/javascript">
var ss_mode_x = "<?php echo $nvram['ss_mode_x']; ?>" || "0";
var ss_dnsproxy_x = "<?php echo $nvram['ss_dnsproxy_x']; ?>" || "0";
var ss_pdnsd_all = "<?php echo $nvram['ss_pdnsd_all']; ?>" || "0";
var app_113 = "<?php echo $nvram['app_113']; ?>" || "0";
var ss_threads = "<?php echo $nvram['ss_threads']; ?>" || "0";
</script>

<!-- Title -->
<!--div class="page-header">
    <h1>Shadowsocks management</h1>
</div-->

<!-- Group Input -->
<div class="row">
    <div class="col-md-12">
        <div class="box" id="add-group">
            <!-- /.box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">
                    全局SS/SSR透明代理(TPROXY)和性能参数
                </h3>
			</div>
			<div class="box-body">
			  <div class="icheck-primary">
				<span>工作模式</span>
				<select id="ss_mode_x" name="ss_mode_x" tabindex="6">
				  <option value="0" selected="">【1】大陆白名单</option>
				  <option value="1">【2】gfwlist</option>
				  <option value="2">【3】全局代理</option>
				  <option value="3">【4】ss-local</option>
				</select>
				<span>TCP端口转发:</span>
				<input id="ss_multiport" name="ss_multiport" type="text" maxlength="512" style="width:35%;" value="<?php echo shell_exec("nvram get ss_multiport") ?>" />
				<br /><br />
				<span>DNS代理模式</span>
				<select id="ss_dnsproxy_x" name="ss_dnsproxy_x" tabindex="8">
				  <option value="0" selected="">dnsproxy</option>
				  <option value="1">pdnsd</option>
				  <option value="2">dnsmasq</option>
				</select>
				
				<label for="ss_pdnsd_all">使用代理服务查询全部DNS</label><input id="ss_pdnsd_all" type="checkbox" name="ss_pdnsd_all" />
				<label for="app_113">DNS China 域名加速</label><input id="app_113" name="app_113" type="checkbox" />
				<hr />
				<span>SS/SSR多线程均衡负载</span>
				<select id="ss_threads" name="ss_threads" class="input" tabindex="45">
					<option value="0">关闭</option>
					<option value="1" selected="">是，自动线程</option>
					<option value="2">是，2 线程</option>
					<option value="3">是，3 线程</option>
					<option value="4">是，4 线程</option>
					<option value="5">是，5 线程</option>
					<option value="6">是，6 线程</option>
					<option value="7">是，7 线程</option>
					<option value="8">是，8 线程</option>
					<option value="9">是，9 线程</option>
					<option value="10">是，10 线程</option>
				</select>
				<button type="button" id="btnTProxyApply" class="btn btn-primary pull-right">Apply</button>
			  </div>
			</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box" id="add-group">
            <!-- /.box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">
                    添加新的 SS/SSR 节点
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-6" style="width:100%;">
                        <label for="new_name">SS/SSR link:</label>
                        <textarea id="new_name" type="text" class="form-control" placeholder="SS/SSR link" style="width:100%;height:100px;"></textarea>
                    </div>
                    <!--div class="form-group col-md-6">
                        <label for="new_desc">Description:</label>
                        <input id="new_desc" type="text" class="form-control" placeholder="Group description (optional)">
                    </div-->
                </div>
            </div>
            <div class="box-footer clearfix">
                <!--strong>Hints:</strong>
                <ol>
                    <li>Multiple groups can be added by separating each group name with a space</li>
                    <li>Group names can have spaces if entered in quotes. e.g "My New Group"</li>
                </ol-->
                <button type="button" id="btnAdd" class="btn btn-primary pull-right">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box" id="groups-list">
            <div class="box-header with-border">
                <h3 class="box-title">
                    SS/SSR 节点列表
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="groupsTable" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th></th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Link</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                </table>
		<button type="button" id="btnApply" class="btn btn-primary pull-right">Apply</button>
                <!--button type="button" id="resetButton" class="btn btn-default btn-sm text-red hidden">Reset sorting</button-->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<script src="<?php echo fileversion('scripts/vendor/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo fileversion('scripts/vendor/bootstrap-toggle.min.js'); ?>"></script>
<script src="<?php echo fileversion('scripts/pi-hole/js/groups.js'); ?>"></script>

<?php
require 'scripts/pi-hole/php/footer.php';
?>
