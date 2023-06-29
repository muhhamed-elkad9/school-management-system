@extends('layouts.master')
@section('css')

@endsection
@section('title')
    {{ __('sections/sections.Sections_list') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('sections/sections.Sections_list') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#"
                            class="default-color">{{ __('sections/sections.sections') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('sections/sections.Sections_list') }}</li>
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
                    msg: '{{ __('sections/sections.Add') }}',
                    type: "success"
                })
            }
        </script>
    @endif


    @if (session()->has('Err'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('sections/sections.Err') }}',
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('deleted'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('sections/sections.deleted') }}',
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
                    <a class="button x-small" href="{{ route('sections.create') }}">
                        {{ __('sections/sections.add_Sections') }}</a>
                </div>

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($Grades as $Grade)
                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $Grade->Name }}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th>#</th>
                                                                        <th>{{ __('sections/sections.Name_Section') }}
                                                                        </th>
                                                                        <th>{{ __('sections/sections.Name_Class') }}</th>
                                                                        <th>{{ __('sections/sections.Status') }}</th>
                                                                        <th>{{ __('sections/sections.Processes') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 0; ?>
                                                                    @foreach ($Grade->Sections as $section)
                                                                        <tr>
                                                                            <?php $i++; ?>
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $section->Name_Section }}</td>
                                                                            <td>{{ $section->ClassRooms->Name_Class }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($section->Status === 1)
                                                                                    <label
                                                                                        class="badge badge-success">{{ __('sections/sections.Status_Section_AC') }}</label>
                                                                                @else
                                                                                    <label
                                                                                        class="badge badge-danger">{{ __('sections/sections.Status_Section_No') }}</label>
                                                                                @endif

                                                                            </td>
                                                                            <td>

                                                                                <a class="btn btn-info btn-sm"
                                                                                    href="{{ route('sections.edit', $section->id) }}"
                                                                                    title="{{ __('sections/sections.Edit') }}"><i
                                                                                        class="fa fa-edit"></i></a>

                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-target="#delete{{ $section->id }}"
                                                                                    title="{{ __('sections/sections.Delete') }}"><i
                                                                                        class="fa fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>


                                                                        <!-- delete_modal_Grade -->
                                                                        <div class="modal fade"
                                                                            id="delete{{ $section->id }}" tabindex="-1"
                                                                            role="dialog"
                                                                            aria-labelledby="exampleModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                            class="modal-title"
                                                                                            id="exampleModalLabel">
                                                                                            {{ __('sections/sections.delete_Section') }}
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form
                                                                                            action="{{ route('sections.destroy', $section->id) }}"
                                                                                            method="get">
                                                                                            @csrf
                                                                                            {{ __('sections/sections.Warning_Section') }}
                                                                                            <input id="id"
                                                                                                type="hidden"
                                                                                                name="id"
                                                                                                class="form-control"
                                                                                                value="{{ $section->id }}">
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">{{ __('sections/sections.Close') }}</button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">{{ __('sections/sections.Save') }}</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
