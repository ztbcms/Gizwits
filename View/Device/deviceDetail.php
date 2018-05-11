<extend name="../../Admin/View/Common/base_layout"/>

<block name="content">
    <style>
        #app{
            background: white;
            height: 100%;
        }
        .text-left{
            text-align: left !important;
        }

    </style>

    <div id="app" style="padding: 8px;" v-cloak>
        <div class="box box-info">
            <ul class="nav nav-tabs">
                <li role="presentation" :class="{'active': tab == 1}" @click="tab=1"><a href="#">设备详情</a></li>
                <li role="presentation" :class="{'active': tab == 2}" @click="tab=2"><a href="#">开关机设置</a></li>
                <li role="presentation" :class="{'active': tab == 3}" @click="tab=3"><a href="#">配置设置</a></li>
                <li role="presentation" :class="{'active': tab == 4}" @click="tab=4"><a href="#">检修设置</a></li>
                <li role="presentation" :class="{'active': tab == 5}" @click="tab=5"><a href="#">滤芯设置</a></li>
            </ul>

            <template v-if="tab == 1">
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">所属产品key</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.product_key }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备mac地址</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.mac }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备ID</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.did }}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备 passcode</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.passcode }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">创建时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.create_time | getFormatTime }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">最后更新时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.update_time | getFormatTime  }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">最后同步时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.sync_at | getFormatTime }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">机智云平台最后上传时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.cloud_update_at | getFormatTime }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否在线</label>
                            <div class="col-sm-10 control-label text-left">
                                <template v-if="device.is_online == 1">
                                    <span style="color: green">在线</span>
                                </template>
                                <template v-else>
                                    <span style="color: grey">离线</span>
                                </template>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否注销</label>
                            <div class="col-sm-10 control-label text-left">
                                <template v-if="device.is_disabled == 1">
                                    <span style="color: grey">已注销</span>
                                </template>
                                <template v-else>
                                    <span style="color: green">正常</span>
                                </template>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">数据点</label>
                            <div class="col-sm-10 control-label text-left">
                                <p>进水TDS值: {{ device.attr.tds_in }}</p>
                                <p>出水TDS值: {{ device.attr.tds_out }}</p>
                                <p>检修状态: {{ device.attr.check_status }}</p>
                                <p>工作运行状态: {{ device.attr.run_status }}</p>
                                <p>警告状态: {{ device.attr.error_status }}</p>
                                <p>进水TDS校准值: {{ device.attr.tds_in_dt }}</p>
                                <p>出水TDS校准值: {{ device.attr.tds_out_dt }}</p>
                                <p>进水流速: {{ device.attr.speed_in }}</p>
                                <p>出水流速: {{ device.attr.speed_out }}</p>
                                <p>设备总用水量: {{ device.attr.used_amount }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10 control-label text-left">
                                <button type="button" class="btn btn-success" @click="getDetail">更新信息</button>
                            </div>
                        </div>


                    </div>
                    <!--                <div class="box-footer">-->
                    <!--                    <button type="submit" class="btn btn-default">Cancel</button>-->
                    <!--                    <button type="submit" class="btn btn-info pull-right">Sign in</button>-->
                    <!--                </div>-->
                </form>
            </template>

            <template v-if="tab == 2">
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备mac地址</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.mac }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备ID</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.did }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">最后同步时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.sync_at | getFormatTime }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否在线</label>
                            <div class="col-sm-10 control-label text-left">
                                <template v-if="device.is_online == 1">
                                    <span style="color: green">在线</span>
                                </template>
                                <template v-else>
                                    <span style="color: grey">离线</span>
                                </template>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">机智云平台最后上传时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.cloud_update_at | getFormatTime }}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">数据点</label>
                            <div class="col-sm-10 control-label text-left">
                                <p>工作运行状态: {{ device.attr.run_status | formatRunStatus}}</p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">开关机</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="radio" value="0" v-model="control_onoff.run_status"> 停机
                                <input type="radio" value="1" v-model="control_onoff.run_status"> 正常开机
                                <input type="radio" value="2" v-model="control_onoff.run_status"> 调试模式开机
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10 control-label text-left">
                               <button class="btn btn-success" type="button" @click="sendCmdOnoff">发送命令</button>
                            </div>
                        </div>
                    </div>
                    <!--                <div class="box-footer">-->
                    <!--                    <button type="submit" class="btn btn-default">Cancel</button>-->
                    <!--                    <button type="submit" class="btn btn-info pull-right">Sign in</button>-->
                    <!--                </div>-->
                </form>
            </template>

            <template v-if="tab == 3">
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备mac地址</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.mac }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备ID</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.did }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">最后同步时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.sync_at | getFormatTime }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否在线</label>
                            <div class="col-sm-10 control-label text-left">
                                <template v-if="device.is_online == 1">
                                    <span style="color: green">在线</span>
                                </template>
                                <template v-else>
                                    <span style="color: grey">离线</span>
                                </template>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">机智云平台最后上传时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.cloud_update_at | getFormatTime }}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">数据点</label>
                            <div class="col-sm-10 control-label text-left">
                                <p>进水TDS校准值: {{ device.attr.tds_in_dt }}</p>
                                <p>出水TDS校准值: {{ device.attr.tds_out_dt }}</p>
                                <p>进水流速: {{ device.attr.speed_in }}</p>
                                <p>出水流速: {{ device.attr.speed_out }}</p>
                                <p>设备总用水量: {{ device.attr.used_amount }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">进水TDS校准值</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_dev_config.tds_in_dt">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">出水TDS校准值</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_dev_config.tds_out_dt">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">进水流速</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_dev_config.speed_in">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">出水流速</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_dev_config.speed_out">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备总用水量</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_dev_config.used_amount">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10 control-label text-left">
                                <button class="btn btn-success" type="button" @click="sendCmdSetDevConfig">发送命令</button>
                            </div>
                        </div>
                    </div>
                    <!--                <div class="box-footer">-->
                    <!--                    <button type="submit" class="btn btn-default">Cancel</button>-->
                    <!--                    <button type="submit" class="btn btn-info pull-right">Sign in</button>-->
                    <!--                </div>-->
                </form>
            </template>

            <template v-if="tab == 4">
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备mac地址</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.mac }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备ID</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.did }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">最后同步时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.sync_at | getFormatTime }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否在线</label>
                            <div class="col-sm-10 control-label text-left">
                                <template v-if="device.is_online == 1">
                                    <span style="color: green">在线</span>
                                </template>
                                <template v-else>
                                    <span style="color: grey">离线</span>
                                </template>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">机智云平台最后上传时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.cloud_update_at | getFormatTime }}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">数据点</label>
                            <div class="col-sm-10 control-label text-left">
                                <p>进水TDS校准值: {{ device.attr.tds_in_dt }}</p>
                                <p>出水TDS校准值: {{ device.attr.tds_out_dt }}</p>
                                <p>进水流速: {{ device.attr.speed_in }}</p>
                                <p>出水流速: {{ device.attr.speed_out }}</p>
                                <p>设备总用水量: {{ device.attr.used_amount }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">检修</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="radio" value="0" v-model="control_set_check.check_status"> 未进入检修
                                <input type="radio" value="1" v-model="control_set_check.check_status"> 进入检修
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10 control-label text-left">
                                <button class="btn btn-success" type="button" @click="sendCmdSetCheck">发送命令</button>
                            </div>
                        </div>
                    </div>
                    <!--                <div class="box-footer">-->
                    <!--                    <button type="submit" class="btn btn-default">Cancel</button>-->
                    <!--                    <button type="submit" class="btn btn-info pull-right">Sign in</button>-->
                    <!--                </div>-->
                </form>
            </template>

            <template v-if="tab == 5">
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备mac地址</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.mac }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">设备ID</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.did }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">最后同步时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.sync_at | getFormatTime }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否在线</label>
                            <div class="col-sm-10 control-label text-left">
                                <template v-if="device.is_online == 1">
                                    <span style="color: green">在线</span>
                                </template>
                                <template v-else>
                                    <span style="color: grey">离线</span>
                                </template>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">机智云平台最后上传时间</label>
                            <div class="col-sm-10 control-label text-left">
                                {{ device.cloud_update_at | getFormatTime }}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">数据点</label>
                            <div class="col-sm-10 control-label text-left">
                                <p>进水TDS校准值: {{ device.attr.tds_in_dt }}</p>
                                <p>出水TDS校准值: {{ device.attr.tds_out_dt }}</p>
                                <p>进水流速: {{ device.attr.speed_in }}</p>
                                <p>出水流速: {{ device.attr.speed_out }}</p>
                                <p>设备总用水量: {{ device.attr.used_amount }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第1号滤芯的通电时间</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.poweron_time1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第1号滤芯的使用量</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.use_amount1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第2号滤芯的通电时间</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.poweron_time2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第2号滤芯的使用量</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.use_amount2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第3号滤芯的通电时间</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.poweron_time3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第3号滤芯的使用量</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.use_amount3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第4号滤芯的通电时间</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.poweron_time4">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第4号滤芯的使用量</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.use_amount4">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第5号滤芯的通电时间</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.poweron_time5">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第5号滤芯的使用量</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.use_amount5">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第6号滤芯的通电时间</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.poweron_time6">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第6号滤芯的使用量</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.use_amount6">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第7号滤芯的通电时间</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.poweron_time7">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">第7号滤芯的使用量</label>
                            <div class="col-sm-10 control-label text-left">
                                <input type="number" v-model="control_set_lvxin_config.use_amount7">
                            </div>
                        </div>





                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10 control-label text-left">
                                <button class="btn btn-success" type="button" @click="sendCmdSetCheck">发送命令</button>
                            </div>
                        </div>
                    </div>
                    <!--                <div class="box-footer">-->
                    <!--                    <button type="submit" class="btn btn-default">Cancel</button>-->
                    <!--                    <button type="submit" class="btn btn-info pull-right">Sign in</button>-->
                    <!--                </div>-->
                </form>
            </template>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            new Vue({
                el: '#app',
                data: {
                    tab: 1,
                    did: "{:I('get.did')}",
                    device: {
                        attr: {
                            tds_in_dt: '',
                            tds_out_dt: '',
                            speed_in: '',
                            speed_out: '',
                            used_amount: '',
                        }
                    },
                    control_onoff: {
                        run_status: ''
                    },
                    control_set_dev_config: {
                        tds_in_dt: '',
                        tds_out_dt: '',
                        speed_in: '',
                        speed_out: '',
                        used_amount: ''
                    },
                    control_set_check: {
                        check_status: ''
                    },
                    control_set_lvxin_config: {
                        poweron_time1: '',
                        use_amount1: '',
                        poweron_time2: '',
                        use_amount2: '',
                        poweron_time3: '',
                        use_amount3: '',
                        poweron_time4: '',
                        use_amount4: '',
                        poweron_time5: '',
                        use_amount5: '',
                        poweron_time6: '',
                        use_amount6: '',
                        poweron_time7: '',
                        use_amount7: '',
                    }
                },
                filters: {
                    getFormatTime: function (value) {
                        if(value == '' || value == 0){
                            return '/';
                        }
                        var time = new Date(parseInt(value * 1000));
                        var y = time.getFullYear();
                        var m = time.getMonth() + 1;
                        var d = time.getDate();
                        var h = time.getHours();
                        var i = time.getMinutes();
                        var res = y + '-' + (m < 10 ? '0' + m : m) + '-' + (d < 10 ? '0' + d : d)
                        res += '  ' + (h < 10 ? '0' + h : h) + ':' + (i < 10 ? '0' + i : i);
                        return res;
                    },
                    formatRunStatus:function(value){
                        if(value == 0){
                            return '停机'
                        }
                        if(value == 1){
                            return '正常运行'
                        }
                        if(value == 1){
                            return '调试模式运行'
                        }
                        return '';
                    }
                },
                methods: {
                    getDetail: function () {
                        var that = this;
                        $.ajax({
                            url: "{:U('Gizwits/Device/getSyncedDeviceByDid', ['did' => I('get.did')])}",
                            dataType: 'json',
                            type: 'get',
                            success: function (res) {
                                var data = res.data;
                                that.device = data
                                that.device.attr = JSON.parse(that.device.attr);
                            }
                        })
                    },
                    //处理消息
                    handleMessage: function (message_id){
                        $.ajax({
                            url: "{:U('Message/Message/handleMessage')}",
                            data: {
                                message_id: message_id
                            },
                            dataType: 'json',
                            type: 'post',
                            success: function (res) {
                                if(res.status){
                                    layer.msg('操作完成！');
                                }else{
                                    layer.msg(res.msg);
                                }
                            }
                        });
                    },
                    sendCmdOnoff: function(){
                        //TODO
                    },
                    sendCmdSetDevConfig: function(){
                        //TODO
                    },
                    sendCmdSetCheck: function(){

                    },
                },
                mounted: function () {
                    this.getDetail();
                }
            })
        })
    </script>
</block>