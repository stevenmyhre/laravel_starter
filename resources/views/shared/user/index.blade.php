@extends('layout')

@section('content')
<h2>Users</h2>
<p>
<table id="userTbl" class="table display">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>User Type</th>
        <th>Account</th>
        <th>Modified</th>
        @if(Context::is_currently_admin())
        <th>Dealer</th>
        @endif
    </tr>
    </thead>
    <tbody>
    
    </tbody>
</table>
</p>
@endsection

@section('scripts')
<script type="text/javascript">
    var tbl;
    $(function() {

        var options = {
            sAjaxSource: "{{$urlBase}}/user/list",
            processing: true,
            serverSide: true,
            pageLength: 10,
            searching: true,
            dom: "lfrtip",
            columns: [
                { 
                    data: "id",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return '<a href="{{$urlBase}}/user/view/' + row.id + '">' + row.name + '</a>';
                    }
                },
                {
                    data: "email"
                },
                {
                    data: "user_type_name",
                },
                {
                    data: "customer_id",
                    render: function(data, type, row, meta) {
                        if(row.customer_id)
                        {
                            return '<a href="{{$urlBase}}/customer/view/' + row.customer_id + '">' + row.full_name + "</a>";
                        }
                        else if(row.dealer_id)
                        {
                            return '<a href="{{$urlBase}}/dealer/view/' + row.dealer_id + '">' + row.dealer_name + '</a> (Dealer)';
                        }
                        else
                        {
                            return "No customer attached";
                        }
                    }
                },
                {
                    data: "updated_at",
                    render: function(data) {
                        var dt = moment.utc(data).local();
                        return dt.format("L");
                    }
                }
                @if(Context::is_currently_admin())
                ,{
                    data: "dealer_name",
                    render: function (data, type, row) {
                        return data ? '<a href="/admin/dealer/view/' + row.dealer_id + '">' + data + '</a>' : "";
                    }
                }
                @endif
            ],
            order: [ [4, "desc"] ],
        };
        tbl = $('#userTbl').DataTable(options);

    });
</script>
@endsection