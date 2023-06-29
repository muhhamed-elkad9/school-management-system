@extends('layouts.master')
@section('css')

@endsection
@section('title')
    {{ __('Classroom/Classroom.Classes_list') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('Classroom/Classroom.Classes') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#"
                            class="default-color">{{ __('Classroom/Classroom.Classroom') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('Classroom/Classroom.Classes_list') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('add'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('Classroom/Classroom.Add') }}',
                    type: "success"
                })
            }
        </script>
    @endif


    @if (session()->has('Err'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('Classroom/Classroom.Err') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('deleted'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('Classroom/Classroom.deleted') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <a class="button x-small" href="{{ route('Classroom.create') }}">
                        {{ __('Classroom/Classroom.add_Class') }}
                    </a>
                    <button type="button" class="button x-small"
                        id="btn_delete_all">{{ __('Classroom/Classroom.Delete_Selected') }}</button>
                    <br><br>


                    <form action="{{ route('Classroom.Filter_Classes') }}" method="POST">
                        {{ csrf_field() }}
                        <select class="selectpicker" data-style="btn-info" name="Grade_id" required
                            onchange="this.form.submit()">
                            <option value="" selected disabled>{{ __('Classroom/Classroom.Search_By_Grade') }}
                            </option>
                            @foreach ($Grades as $Grade)
                                <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                            @endforeach
                        </select>
                    </form>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th><input name="select_all" id="example-select-all" type="checkbox"
                                            onclick="CheckAll('box1', this)" /></th>
                                    <th>#</th>
                                    <th>{{ __('Classroom/Classroom.Name') }}</th>
                                    <th>{{ __('Classroom/Classroom.Name_grade') }}</th>
                                    <th>{{ __('Classroom/Classroom.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (isset($details))
                                    <?php $List_Classes = $details; ?>
                                @else
                                    <?php $List_Classes = $Classroom; ?>
                                @endif


                                <?php $i = 0; ?>
                                @foreach ($List_Classes as $Class)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>
                                            <input type="checkbox" value="{{ $Class->id }}" class="box1" />
                                        </td>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Class->Name_Class }}</td>
                                        <td>{{ $Class->Grades->Name }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('Classroom.edit', $Class->id) }}"
                                                title="{{ __('Classroom/Classroom.Edit') }}"><i class="fa fa-edit"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $Class->id }}"
                                                title="{{ __('Classroom/Classroom.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>




                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $Class->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ __('Classroom/Classroom.delete_class') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('Classroom.destroy', $Class->id) }}"
                                                        method="get">
                                                        @csrf
                                                        {{ __('Classroom/Classroom.Warning_class') }}
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $Class->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('Classroom/Classroom.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('Classroom/Classroom.Delete') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>


            <!-- حذف مجموعة صفوف -->
            <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ __('Classroom/Classroom.delete_classes') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="{{ route('Classroom.destroySelect') }}" method="POST">

                            @csrf
                            <div class="modal-body">
                                {{ __('Classroom/Classroom.Warning_classes') }}
                                <input class="text" type="hidden" id="delete_all_id" name="delete_all_id"
                                    value=''>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('Classroom/Classroom.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-danger">{{ __('Classroom/Classroom.Delete') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')



    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>

@endsection
