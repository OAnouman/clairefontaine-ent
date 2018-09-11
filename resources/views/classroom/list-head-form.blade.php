
<div class="row">
    
    
    <div class="col-md-3" style="margin-bottom: 10px;">
    
    
        <button class="btn btn-default" type="button" @click="hideShow($event)">
        
            Ajouter
    
        </button>
        
        
    </div>
    
    <div class="col-md-12">
        
        
        
        <form id="classroom-student-form" @submit.prevent ="onClassroomStudentFormSubmit($event)"
              class="form-inline" style="display: none;">
            
            
            <fieldset>
                
                
                <div id="classroom-select" class = "form-group col-md-3" style="padding-left: 0;">
                    
                    <label for="classroom_id" class="sr-only" >Classe</label>
                    
                    <select required id = "classroom_id" data-header="Sélect. une classe"
                            class = "form-control selectpicker show-tick" name = "classroom_id"
                            data-live-search="true" title="Classe" data-size="10" data-show-subtext="true">
                        
                        
                        @foreach($classrooms as $classroom)
                            
                            
                            <option data-tokens="{{ $classroom->name }}"
                                    data-subtext="{{
                                        $classroom->teacher_id ?
                                            $classroom->teacher->firstname . ' ' . $classroom->teacher->lastname
                                            : 'Non attribué'
                                    }}"
                                    value = "{{ $classroom->id }}">{{ $classroom->name }}</option>
                        
                        
                        @endforeach
                    
                    
                    </select>
                
                
                </div> <!-- End classroom -->
                
                <div id="student-select" class = "form-group col-md-6">
                    
                    
                    <label for="student_id" class="sr-only" >Elève</label>
                    
                    <select required id = "student_id" data-header="Sélectionner un élève"
                            class = "form-control selectpicker show-tick" name = "student_id"
                            data-live-search="true" title="Elève" data-size="10">


                        @foreach($allStudents as $student)


                            <option data-tokens="{{ $student->lastname . ' ' . $student->firstname }}"
                                    value="{{ $student->id }}">

                                {{ $student->lastname . ' ' . $student->firstname }}
                            
                            </option>
                        
                        
                        @endforeach
                    
                    
                    </select>
                
                
                </div> <!-- End student -->
                
                <div class="col-md-2" style="margin-top: 6px;">
                    
                    
                    <label class="checkbox-inline">
                        
                        
                        <input type="checkbox" name="redouble"
                               id="redouble" value="1">
                        
                        Redouble
                    
                    
                    </label>
                
                
                </div> <!-- End redouble  -->
                
                <div class="col-md-1" style="margin-left: -35px"> <!-- End button -->
                    
                    
                    <button type="submit" role="button" class="btn btn-primary">
                        
                        
                        Ajouter
                    
                    
                    </button>
                
                
                </div>
                
                
            </fieldset>
        
        
        </form>
    
    
    </div>


</div>