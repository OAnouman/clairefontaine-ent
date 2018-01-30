<?php


namespace App\Providers;


use App\Observers\GradeObserver;
use App\Observers\StudentObserver;
use App\Observers\TeacherObserver;
use App\Student;
use App\Teacher;
use App\Grade;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {


        //Register Teacher observer

        Teacher::observe(TeacherObserver::class);

        // Register Student observer

        Student::observe(StudentObserver::class);

        // Register Grade observer

        Grade::observe(GradeObserver::class);


    }



    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        //
    }
}
