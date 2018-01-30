
<!-- Emergency People list -->

<table id="emergencyPeopleList" class="table-responsive table-condensed" style="border: none">
    
    
    @foreach($student->emergencyPeople as $emergencyPeople)
        
        
        <tr>
            
            
            <td class="col-md-4">
                
                {{ $emergencyPeople->name }}
            
            </td>
            
            <td class="col-md-3">
                
                {{ $emergencyPeople->link }}
            
            </td>
            
            <td class="col-md-5">
                
                {{ $emergencyPeople->phones }}
            
            </td>
    
            <td>
    
                <a onclick="emergencyPeopleDeletion()" href="#"
                   title="Supprimer" data-toggle="tooltip"
                   data-placement="top">
        
        
                    <span  class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
        
                    {{-- Form for requesting deletion --}}
        
                    <form action="">
            
            
                        <input type="hidden" name="emergency_people_id" value="{{ $emergencyPeople->id }}">
                        
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        
        
                    </form>
    
    
                </a>
    
            </td>
        
        
        </tr>
    
    
    @endforeach


</table>

