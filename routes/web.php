<?php

use App\Http\Controllers\{
    Category\CategoryController,
    Dashboard\DashboardController,
    Dashboard\ProductController,
    Dashboard\ReportController,
    Dashboard\RolePermission\PermissionController,
    Dashboard\RolePermission\RoleController,
    Dashboard\SaleController,
    Dashboard\TransactionController,
    Dashboard\TrashController,
    Dashboard\UserController,
    IndexController,
    Dashboard\OrderController,
    Dashboard\ProfileController
};
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Unit\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('/symlink', function () {
    Artisan::call('storage:link');
    echo "ok";
});

Route::middleware('auth')->group(function () {
    Route::get('user-table', [UserController::class, 'userTable'])->name('users.table');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::resource("categories", CategoryController::class, ['names' => 'category'])->parameters([
            'category' => 'slug'
        ]);
        Route::get('categories-table', [CategoryController::class, 'categoriesTable'])->name('categories.table');

        Route::resource("units", UnitController::class, ['names' => 'unit'])->parameters([
            'unit' => 'slug'
        ]);
        Route::get('units-table', [UnitController::class, 'unitsTable'])->name('units.table');

        Route::resource("suppliers", SupplierController::class)->parameters([
            'supplier' => 'slug'
        ]);
        Route::get("suppliers-table", [SupplierController::class, 'suppliersTable'])->name('suppliers.table');

        Route::resource('products', ProductController::class)->parameters([
            'product' => 'slug'
        ]);
        Route::prefix('orders')->group(function () {
            Route::get('', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/{order:uuid}', [OrderController::class, 'create'])->name('orders.manage');
            Route::get('/get-supplier', [SupplierController::class, 'getSupplier'])->name("order.supplier");
            Route::post('/store', [OrderController::class, 'store'])->name("store.supplier");
            Route::get('/detail/{order:uuid}', [OrderController::class, 'getDetailOrder'])->name("order.detail");
            Route::get('get-product', [ProductController::class, 'getProduct']);
            Route::post('post-detail-order/{order:uuid}', [OrderController::class, 'postDetailOrder'])->name("order.detail.product.create");
            Route::get('get-detail-order/{order:uuid}', [OrderController::class, 'getDetailOrderProduct'])->name("order.detail.product.table");
            Route::put('update-detail-product/{order:uuid}', [OrderController::class, 'updateDetailOrder'])->name('orders.detail.product.update');
            Route::delete('delete-detail-product/{order:uuid}', [OrderController::class, 'deleteDetailOrder'])->name('orders.detail.product.delete');
            Route::put('save-order/{order:uuid}', [OrderController::class, 'saveOrder'])->name('order.save');
            Route::get('show/{order:uuid}', [OrderController::class, 'show'])->name('orders.show');
            Route::delete('reset-order/{order:uuid}', [OrderController::class, 'resetOrder'])->name('order.reset');
            Route::delete('cancel-order/{order:uuid}', [OrderController::class, 'cancelOrder'])->name('order.cancel');
        });
        Route::get('orders-table', [OrderController::class, 'ordersTable'])->name('orders.table');
        Route::get('products-table', [ProductController::class, 'productsTable'])->name('products.table');
        Route::get('generate-pdf', [ProductController::class, 'generatePDF'])->name('product.pdf');
        Route::get('generate-excel', [ProductController::class, 'generateExcel'])->name('product.excel');

        Route::prefix('sales')->middleware(['permission:view-sales'])->group(function () {
            Route::get('', [SaleController::class, 'index'])->name('sales.index');
            Route::get('{sale:uuid}', [SaleController::class, 'show'])->name('sales.show');
            Route::get('{sale:uuid}/detail-table', [SaleController::class, 'salesDetailTable'])->name('sales.detail.table');
            Route::get('{sale:uuid}/invoice', [SaleController::class, 'printInvoice'])->name('sales.detail.invoice');
        });
        Route::get('sales-table', [SaleController::class, 'salesTable'])->name('sales.table')
            ->middleware(['permission:view-sales']);

        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/filters/{start_date}/{end_date}', [ReportController::class, 'reportsTable'])->name('reports.table');
        Route::get('reports/filters/{start_date}/{end_date}/export-pdf', [ReportController::class, 'exportPDF'])->name('reports.export-pdf');

        Route::prefix('transactions')->middleware(['permission:create-transaction'])->group(function () {
            Route::get('', [TransactionController::class, 'create'])->name('transactions.create');
            Route::get('{sale:uuid}', [TransactionController::class, 'index'])->name('transactions.index');
            Route::get('{sale:uuid}/sale-detail', [TransactionController::class, 'getSaleProductDetail'])->name('transactions.sale-detail');
            Route::put('{sale:uuid}/save-transaction', [TransactionController::class, 'saveTransaction'])->name('transactions.save');
            Route::delete('{sale:uuid}/cancel-transaction', [TransactionController::class, 'cancelTransaction'])->name('transactions.cancel');
        });
        Route::get('select-products', [ProductController::class, 'selectProducts'])->name('select.products');
        Route::get('select-products-order', [ProductController::class, 'selectProductsOrder'])->name('select.products.order');

        Route::prefix('role-permission')->group(function () {
            Route::group(['middleware' => 'permission:view-permissions'], function () {
                Route::resource('permissions', PermissionController::class)
                    ->except(['create']);
                Route::get('permissions-table', [PermissionController::class, 'table'])->name('permissions.table');
            });

            Route::group(['middleware' => 'permission:view-role'], function () {
                Route::resource('roles', RoleController::class)
                    ->except(['create']);
                Route::prefix('roles')->group(function () {
                    Route::get('users-table/{role}', [RoleController::class, 'usersTable'])->name('roles.users.table');
                    Route::post('assign-role/{role}', [RoleController::class, 'assignRole'])->name('assign-role');
                    Route::delete('revoke-role/{role}', [RoleController::class, 'revokeRole'])->name('roles.user.revoke');
                });
            });
        });

        Route::prefix('trash')->group(function () {
            Route::get('products', [TrashController::class, 'productsTrashed'])->name('trash.products')
                ->middleware(['permission:view-products-trash']);
            Route::get('products-trashed-table', [TrashController::class, 'productsTrashedTable'])->name('trash.products.table');
            Route::put('products/{slug}', [TrashController::class, 'productsRestore'])->name('trash.products.restore')
                ->middleware(['permission:restore-product']);
            Route::get('units', [TrashController::class, 'unitsTrashed'])->name('trash.units')
                ->middleware(['permission:view-units-trash']);
            Route::get('units-trashed-table', [TrashController::class, 'unitsTrashedTable'])->name('trash.units.table');
            Route::put('units/{slug}', [TrashController::class, 'unitsRestore'])->name('trash.units.restore')
                ->middleware(['permission:restore-unit']);
            Route::get('categories', [TrashController::class, 'categoriesTrashed'])->name('trash.categories')
                ->middleware(['permission:view-categories-trash']);
            Route::get('categories-trashed-table', [TrashController::class, 'categoriesTrashedTable'])->name('trash.categories.table');
            Route::put('categories/{slug}', [TrashController::class, 'categoriesRestore'])->name('trash.categories.restore')
                ->middleware(['permission:restore-category']);
            Route::get('suppliers', [TrashController::class, 'suppliersTrashed'])->name('trash.suppliers')
                ->middleware(['permission:view-suppliers-trash']);
            Route::get('suppliers-trashed-table', [TrashController::class, 'suppliersTrashedTable'])->name('trash.suppliers.table');
            Route::put('suppliers/{slug}', [TrashController::class, 'suppliersRestore'])->name('trash.suppliers.restore')
                ->middleware(['permission:restore-supplier']);
        });

        Route::resource('users', UserController::class)->only(['index', 'create', 'store'])->middleware(['permission:view-users']);
        Route::get('users-table', [UserController::class, 'userTableWithRoles'])->name('users.index.table');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    });
});
