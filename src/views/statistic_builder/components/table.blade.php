@if($command=='layout')
    <div id='{{$componentID}}' class='border-box'>

        <div class="panel panel-default" style="border-radius: 15px;">
            <div class="panel-heading" style="border-radius: 15px; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                [name]
            </div>
            <div class="panel-body table-responsive no-padding">
                [sql]
            </div>
        </div>

        <div class='action pull-right'>
            <a href='javascript:void(0)' data-componentid='{{$componentID}}' data-name='Small Box' class='btn-edit-component'><i class='fa fa-pencil'></i></a>
            &nbsp;
            <a href='javascript:void(0)' data-componentid='{{$componentID}}' class='btn-delete-component'><i class='fa fa-trash'></i></a>
        </div>
    </div>
@elseif($command=='configuration')
    <form method='post'>
        <input type='hidden' name='_token' value='{{csrf_token()}}'/>
        <input type='hidden' name='componentid' value='{{$componentID}}'/>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" required name='config[name]' type='text' value='{{@$config->name}}'/>
        </div>

        <div class="form-group">
            <label>SQL Query</label>
            <textarea name='config[sql]' rows="5" placeholder="E.g : select column_id,column_name from view_table_name"
                      class='form-control'>{{@$config->sql}}</textarea>
            <div class='help-block'>
                Make sure the sql query are correct unless the widget will be broken. Mak sure give the alias name each column. You may use alias [SESSION_NAME]
                to get the session. We strongly recommend that you use a <a href='http://www.w3schools.com/sql/sql_view.asp' target='_blank'>view table</a>
            </div>
        </div>

    </form>
@elseif($command=='showFunction')
    <?php
    if($key == 'sql') {
    try {
        $sessions = Session::all();
        foreach ($sessions as $key => $val) {
            $value = str_replace("[".$key."]", $val, $value);
        }
        $sql = DB::select(DB::raw($value));
    } catch (\Exception $e) {
        die('ERROR');
    }
    ?>

    @if($sql)
    
    <div style="margin:0px 10px 0px 10px; border-radius: 7px; border: 0px solid #ccc; padding: 10px;">
        <table class='table table-hover table-bordered' style="text-align: center; border-radius: 7px; border: solid 1px lightgrey; overflow: hidden; text-align:center">
            <thead>
            <tr>
                @foreach($sql[0] as $key=>$val)
                    <th style="text-transform:capitalize; color: #0492C2; text-align:center; border-bottom: 1px;">{{$key}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($sql as $row)
                <tr>
                    @foreach($row as $key=>$val)
                        <td style="border-color:#ccc">{{$val}}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
        <script type="text/javascript">
            $('table.table').DataTable({
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        </script>
    @endif
    <?php
    }else {
        echo $value;
    }
    ?>
@endif  

