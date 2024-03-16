<?php

namespace App\Admin\Controllers\Patient;

use App\Models\Patient;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\PatientActivity;

class PatientActivityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PatientActivity';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PatientActivity());

        $grid->column('id', __('Id'));
        $grid->column('patient_id', __('Patient id'));
        $grid->column('Activity', __('Activity'));
        $grid->column('date_time', __('Date time'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(PatientActivity::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('patient_id', __('Patient id'));
        $show->field('Activity', __('Activity'));
        $show->field('date_time', __('Date time'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PatientActivity());

        $form->select('patient_id', __('Patient id'))->options(Patient::all()->pluck('name', 'id'));
        $form->textarea('Activity', __('Activity'));
        $form->datetime('date_time', __('Date time'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
