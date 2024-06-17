<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href = '" . route('vendor.products.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href = '" . route('vendor.products.destroy', $query->id) . "' class='btn btn-danger delete-item' style='margin-left: 4px !important;'><i class='fas fa-trash-alt'></i></a>";
                $moreButton = '<div class="btn-group dropstart">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" style="margin-left: 4px !important;" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu">

                                           <li> <a class="dropdown-item has-icon" href="' . route('vendor.products-image-gallery.index', ['product' => $query->id]) . '"><i class="far fa-heart"></i> Image Gallery</a></li>
                                           <li> <a class="dropdown-item has-icon" href="' . route('vendor.products-variant.index', ['product' => $query->id]) . '"><i class="far fa-file"></i> Characteristic</a> </li>

                                    </ul>
                                </div>';

                return $editBtn . $deleteBtn . $moreButton;
            })
            ->addColumn('image', function ($query) {
                return $img = "<img width='70px' src = '" . asset($query->thumb_image) . "' />";
            })
            ->addColumn('type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival' :
                        return "<i class='badge bg-success'>New arrival</i>";
                        break;
                    case 'featured' :
                        return "<i class='badge bg-warning'>Featured</i>";
                        break;
                    case 'top_product' :
                        return "<i class='badge bg-info'>Top product</i>";
                        break;
                    case 'best_product' :
                        return "<i class='badge bg-danger'>Best product</i>";
                        break;
                    default :
                        return "<i class='badge bg-danger'>None</i>";

                }
            })

            ->addColumn('is_approved', function ($query) {
                $active = "<i class='badge bg-success'>Approved</i> ";
                $inactive = "<i class='badge bg-warning'>Pending</i> ";
                if($query->is_approved == 1){
                    return $active;
                }else{
                    return $inactive;
                }

            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<div class="form-check form-switch">
                                    <input class="form-check-input change-status" style="height: 20px !important; width: 50px !important;" data-id="' . $query->id . '" type="checkbox" checked name="custom-switch-checkbox" >
                                </div>';
                } else {
                    $button = '<div class="form-check form-switch">
                                    <input class="form-check-input change-status" style="height: 20px !important; width: 50px !important;" data-id="' . $query->id . '" type="checkbox" name="custom-switch-checkbox" >
                                </div>';
                }
                return $button;

            })
            ->rawColumns(['image', 'action', 'status', 'type', 'is_approved'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproduct-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('image')->width(150),
            Column::make('name'),
            Column::make('price'),
            Column::make('is_approved'),
            Column::make('type')->width(100),
            Column::make('status')->width(100),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
