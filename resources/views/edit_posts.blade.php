@extends('masterAdmin')
@section('content')



<div id="main">


    <h3>Edit Posts</h3>
    <div style="overflow-x:auto;">
        <table>

            <tr>
                <th width="10%">Sl no.</th>
                <th width="70%">Title</th>
                <th>posted on</th>
                <th>Action</th>
            </tr>
            @foreach($posts as $value)
            <tr id="{{ $value->id }}">

                <td></td>

                <td>{{ $value->heading }}</td>

                <td>{{ $value->posted_at }}</td>
                <td>
                    <form method="post" action="{{ url('/admin/update') }}">
                        {{ csrf_field() }}
                        <input name="id" value="{{ $value->id }}" style="display:none">
                        <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                    </form>
                    <form method="post" action="{{ url('/admin/delete') }}">
                        {{ csrf_field() }}
                        <input name="id" value="{{ $value->id }}" style="display:none">
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach

        </table>
    </div>
    <button class="btn btn-primary btn-sm" onclick="window.location.href = '/admin/add_post';">Add New</button>






</div>

@endsection