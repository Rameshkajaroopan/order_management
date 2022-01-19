<?php

namespace App\Exports;

use App\Models\Order;

use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithEvents
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["id", "Serial Number", "Customer Name", "Mobile", "Item", "Weight", "Total Amount", "Paid Amount", "Payment Mode", "Created Date", "Due Date", "Created Branch", "Created User", "Address"];
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        return  Order::join('users', 'orders.created_user_id', '=', 'users.id')
            ->join('branches', 'orders.created_branch_id', '=', 'branches.id')
            ->where('orders.working_status', '=', 'Completed')
            ->select('orders.id', 'orders.serial_number', 'orders.customer_name', 'orders.mobile', 'orders.Item', 'orders.weight', 'orders.total_amount', 'orders.paid_amount', 'orders.payment_mode', 'orders.created_date', 'orders.due_date', 'branches.name', 'users.first_name', 'orders.address')
            ->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:N1')
                    ->getFont()
                    ->setBold(true);

                    // $event->sheet->setWidth(array(
                    //     'A'     =>  100,
                    //     'B'     =>  10
                    // ));   
            }
        ];
    }
}
