<extend name="../../Admin/View/Common/base_layout"/>

<block name="content">
    <style>
        #app{
            background: white;
            height: 100%;
        }
    </style>

    <div id="app" style="padding: 8px;" v-cloak>
        <h4>设备列表</h4>
        <hr>
        <div class="search_type cc mb10">
            mac：<input type="text" v-model="where.mac" name="" class="input">
            设备ID：<input type="text" v-model="where.did" name="" class="input">
            在线状态：<select v-model="where.is_online" style="background: white;height: 28px;">
                <option value="">全部</option>
                <option value="1">在线</option>
                <option value="0">离线</option>
            </select>
            注销状态：<select v-model="where.is_disabled" style="background: white;height: 28px;">
                <option value="">全部</option>
                <option value="1">已注销</option>
                <option value="0">正常</option>
            </select>
            <button @click="getList" class="btn btn-primary" style="margin-left: 8px;">搜索</button>
        </div>
        <hr>
        <form action="" method="post">
            <div class="table_list">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr style="background: ghostwhite;">
                        <td width="50" align="center">Product Key</td>
                        <td width="100" align="center">设备mac地址</td>
                        <td width="100" align="center">设备ID</td>
                        <td width="100" align="center">是否在线</td>
                        <td width="80" align="center">是否注销 </td>
                        <td width="80" align="center">创建时间</td>
                        <td width="120" align="center">最后同步时间</td>
                        <td width="120" align="center">操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items">
                        <td align="center">
                            {{ item.product_key }}
                        </td>
                        <td align="center">
                            {{ item.mac }}
                        </td>
                        <td align="center">
                            {{ item.did }}
                        </td>
                        <td align="center">
                            <template v-if="item.is_online == 1">
                                <span style="color: green">在线</span>
                            </template>
                            <template v-else>
                                <span style="color: grey">离线</span>
                            </template>
                        </td>
                        <td align="center">
                            <template v-if="item.is_disabled == 1">
                                <span style="color: grey">已注销</span>
                            </template>
                            <template v-else>
                                <span style="color: green">正常</span>
                            </template>
                        </td>
                        <td align="center">{{ item.create_time | getFormatTime }}</td>
                        <td align="center">{{ item.sync_at | getFormatTime }}</td>
                        <td align="center">
                            <button type="button" class="btn btn-primary" @click="goDetail(item.did)">查看详情</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div v-if="page_count > 1" style="text-align: center">
                    <ul class="pagination pagination-sm no-margin">
                        <li>
                            <a @click="page > 1 ? (page--) : '' ;getList()" href="javascript:;">上一页</a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ page }} / {{ page_count }}</a>
                        </li>
                        <li><a @click="page<page_count ? page++ : '' ;getList()" href="javascript:;">下一页</a></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            new Vue({
                el: '#app',
                data: {
                    items: [],
                    page: 1,
                    limit: 20,
                    page_count: 0,
                    total: 0,
                    where: {
                        is_online: '',
                        is_disabled: '',
                        mac: '',
                        did: ''
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
                },
                methods: {
                    getList: function () {
                        var that = this;
                        var where = {
                            page: this.page,
                            limit: this.limit,
                            where: this.where
                        };
                        $.ajax({
                            url: "{:U('Gizwits/Device/getDeviceList')}",
                            data: where,
                            dataType: 'json',
                            type: 'post',
                            success: function (res) {
                                var data = res.data;
                                that.items = data.items;
                                that.page = data.page;
                                that.limit = data.limit;
                                that.page_count = data.page_count;
                            }
                        })
                    },
                    goDetail: function (did){
                        var that = this;
                        layer.open({
                            type: 2,
                            title: '详情',
                            content: '{:U("Gizwits/Device/deviceDetail")}&did='+did,
                            area: ['70%', '70%'],
                            end: function(){
                                that.getList();
                            }
                        });
                    }
                },
                mounted: function () {
                    this.getList();
                }
            })
        })
    </script>
</block>