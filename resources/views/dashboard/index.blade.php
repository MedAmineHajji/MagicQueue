@extends('layout')

@section('content')
    <div style="margin-top: 60px">
        <div class="row w-100">
            <div class="col-lg-3 vh-100" style="background-color: azure">
                <h3>
                    Templates List
                </h3>
                <ul>
                    @foreach ($templates as $template)
                        <li>
                            <a href="{{ '/dashboard/' . $template->getFilename() }}">
                                {{ str_replace('.blade.php', '', $template->getFilename()) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if (isset($templateContent))
                <div class="col-lg vh-100" >
                    <div style="margin-left: auto; margin-right: auto; margin-top: 10%; width: 60%; background-color:white">
                        @include('dashboard._template')
                    </div>
                    {{-- <div style="margin-top: 15%">
                        <form method="POST" action={{"/edit?template=" . str_replace('.blade.php', '', $template->getFilename())}}>
                            @csrf
                            <button id="save-button">Save</button>
                        </form>
                    </div> --}}
                </div>
            @endif

        </div>
        
    </div>
@endsection
