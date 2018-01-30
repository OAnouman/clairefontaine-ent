@extends('layouts.teacher.teacher_master')



@section('breadcrumb')
    
    
    <li>
        
        <a href="{{ route('home') }}">Accueil</a>
    
    </li>

    <li>
    
        Centre de messagerie

    </li>

@endsection


@section('work-section')
    
    
    
    <div class="row">
    
    
        <div class="col-md-12">
            
            
            <div class="pull-right">
        
        
                <button @click="submitMessageThreadForm" class="btn btn-success" type="button">
            
                    <i class="fa fa-comment-o" aria-hidden="true"></i> Nouveau message
        
                </button>
    
    
            </div>
            
            <form id="message-thread-form" method="POST" action="{{ route('message_center.store') }}">
    
    
                {{ csrf_field() }}
                
                <div class = "form-group col-md-5 pull-right">
        
        
                    <label class="sr-only" for = "recipient_id">
                    
                        Destinataire
                    
                    </label>
        
                    <select required id = "recipient_id" title = "Elève..." data-live-search = "true"
                            class = "form-control selectpicker show-tick" name = "recipient">
            
            
                        @foreach($students as $student )
                
                
                            <option data-tokens="{{ $student->lastname . ' ' . $student->firstname }}"
                                    value = "{{ $student->user->id }}">{{ $student->lastname . ' ' . $student->firstname }}</option>
            
            
                        @endforeach
        
        
                    </select>
    
    
                </div> <!-- End recipient -->
                
                
            </form>

            
        </div>
        
        
    </div>
    
    <div>
        
    
        <panel-default>
        
        
            <!-- Panel header -->
        
        
            <template slot = "header">
            
                <span class = "glyphicon glyphicon-comment"></span> &nbsp; Centre de messagerie
    
                <span class="pull-right label
                    {{ auth()->user()->userable->unreadMessages() > 0 ? 'label-danger' : 'label-default'}} ">
                    
                        {{ auth()->user()->userable->unreadMessages() }}
                    
                </span>
        
            </template>
        
            {{-- Setting Carbon locale --}}
            
            @php( \Carbon\Carbon::setLocale('fr') )
        
            <!-- Panel content -->
        
            <table class="table table-responsive table-hover">
            
            
                <thead>
            
            
                <tr>
                
                    
                    <th class="col-md-4">
                    
                        <strong>
                        
                            Destinataire
                    
                        </strong>
                
                    </th>
                
                    <th class="col-md-2">
                    
                        <strong>
                        
                            Dernière activité
                    
                        </strong>
                
                    </th>
                
                    <th class="col-md-6">
                    
                        <strong>
                        
                            Dernier message
                    
                        </strong>
                
                    </th>
    
                    <th>
        
                    
    
                    </th>
            
            
                </tr>
            
            
                </thead>
            
                <tbody>
            
            
                @foreach($messageThreads as $messageThread)
                
                
                    <tr @click="showMessageThread($event)" style="cursor: pointer;"
                        data-href="{{ route('message_center.show', $messageThread->id) }}">
                    
                    
                        <td>
                        
                        
                            @if ( ! $messageThread->originatorUser->userable instanceof App\Teacher ) {{-- If originator is not teacher--}}
                            
                            
                                @if ($messageThread->originatorUser->userable instanceof App\Student)
        
                                    <img src="{{ asset( config('image.uploads_path') . '/' . $messageThread->originatorUser->userable->picture) }}"
                                         class="img-circle" width="45" height="45"/>
                            
                                @endif
                        
                                {{  $messageThread->originatorUser->lastname . ' ' . $messageThread->originatorUser->firstname }}
                        
                        
                            @else {{-- If it a teacher --}}
                            
                            
                                @if ($messageThread->recipientUser->userable instanceof App\Student)
                                
                                    <img src="{{ asset( config('image.uploads_path') . '/' . $messageThread->recipientUser->userable->picture) }}"
                                         class="img-circle" width="45" height="45"/>
                            
                                @endif
                        
                                {{  $messageThread->recipientUser->lastname . ' ' . $messageThread->recipientUser->firstname }}
                        
                        
                            @endif
                    
                    
                        </td>
                    
                        <td>
                            
                            {{ $messageThread->messages->count() > 0 ?
                                $messageThread->messages()->latest()->first()->created_at->diffForHumans() :
                                  $messageThread->created_at->diffForHumans()}}
                    
                        </td>
                    
                        <td>
    
                            {{ $messageThread->messages->count() > 0 ?
                                $messageThread->messages()->latest()->first()->body : ''}}
                    
                        </td>
    
                        <td>
        
                            @if($messageThread->unseenMessages() > 0)
        
                                <span class="label label-danger">
                                    
                                        {{ $messageThread->unseenMessages() }}
                                    
                                </span>
                                
                            @endif
    
                        </td>
                
                
                
                    </tr>
            
            
                @endforeach
            
            
                </tbody>
        
        
            </table>
    
    
        </panel-default>
        
        
    </div>
    
    

@endsection