<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// USE statements harus di atas, sebelum class
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Report Controller
 * Laporan penjualan — hanya manager & admin
 */
class Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Report_model', 'User_model', 'Product_model'));
    }

    /**
     * Halaman laporan utama (per sales)
     */
    public function index()
    {
        $this->requireRole(array('admin', 'manager'));

        $date_from = $this->input->get('date_from') ?: date('Y-m-01');
        $date_to   = $this->input->get('date_to')   ?: date('Y-m-d');
        $user_id   = $this->input->get('user_id')   ?: NULL;

        $data['report']     = $this->Report_model->getReportBySales($date_from, $date_to, $user_id);
        $data['sales_list'] = $this->User_model->getSalesUsers();
        $data['date_from']  = $date_from;
        $data['date_to']    = $date_to;
        $data['user_id']    = $user_id;
        $data['title']      = 'Laporan Per Sales';
        $this->loadView('report/by_sales', $data);
    }

    /**
     * Laporan per produk
     */
    public function byProduct()
    {
        $this->requireRole(array('admin', 'manager'));

        $date_from  = $this->input->get('date_from')  ?: date('Y-m-01');
        $date_to    = $this->input->get('date_to')    ?: date('Y-m-d');
        $product_id = $this->input->get('product_id') ?: NULL;

        $data['report']       = $this->Report_model->getReportByProduct($date_from, $date_to, $product_id);
        $data['product_list'] = $this->Product_model->getAllProducts();
        $data['date_from']    = $date_from;
        $data['date_to']      = $date_to;
        $data['product_id']   = $product_id;
        $data['title']        = 'Laporan Per Produk';
        $this->loadView('report/by_product', $data);
    }

    /**
     * Laporan per periode
     */
    public function byPeriod()
    {
        $this->requireRole(array('admin', 'manager'));

        $date_from = $this->input->get('date_from') ?: date('Y-m-01');
        $date_to   = $this->input->get('date_to')   ?: date('Y-m-d');

        $data['report']    = $this->Report_model->getReportByPeriod($date_from, $date_to);
        $data['date_from'] = $date_from;
        $data['date_to']   = $date_to;
        $data['title']     = 'Laporan Per Periode';
        $this->loadView('report/by_period', $data);
    }

    /**
     * Export PDF laporan per sales
     * Menggunakan dompdf
     */
    public function exportPdf()
    {
        $this->requireRole(array('admin', 'manager'));

        $date_from = $this->input->get('date_from') ?: date('Y-m-01');
        $date_to   = $this->input->get('date_to')   ?: date('Y-m-d');
        $user_id   = $this->input->get('user_id')   ?: NULL;

        $report = $this->Report_model->getOrdersForPdf($date_from, $date_to, $user_id);
        $total_all = array_sum(array_column((array)$report, 'total'));

        // Load dompdf autoload
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

        $options = new Options();
        $options->set('isHtml5ParserEnabled', TRUE);
        $options->set('isRemoteEnabled', FALSE);

        $dompdf = new Dompdf($options);

        // Buat HTML untuk PDF
        $html  = '<!DOCTYPE html><html><head><meta charset="UTF-8">';
        $html .= '<style>
            body { font-family: Arial, sans-serif; font-size: 12px; }
            h2   { text-align: center; margin-bottom: 5px; }
            p.sub{ text-align: center; color: #555; margin-top: 0; }
            table{ width: 100%; border-collapse: collapse; margin-top: 15px; }
            th   { background: #3a5bc7; color: #fff; padding: 7px 5px; text-align: center; }
            td   { padding: 6px 5px; border-bottom: 1px solid #ddd; }
            tr:nth-child(even) td { background: #f9f9f9; }
            .total-row td { font-weight: bold; background: #eef2ff; }
            .text-right { text-align: right; }
            .text-center { text-align: center; }
        </style></head><body>';
        $html .= '<h2>PT MAJU JAYA — Laporan Penjualan</h2>';
        $html .= '<p class="sub">Periode: ' . $date_from . ' s/d ' . $date_to . '</p>';
        $html .= '<table>';
        $html .= '<thead><tr>
            <th>#</th>
            <th>No. Order</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Sales</th>
            <th>Total</th>
            <th>Status</th>
        <tr></thead><tbody>';

        $no = 1;
        foreach ($report as $row) {
            $html .= '<tr>';
            $html .= '<td class="text-center">' . $no++ . '</td>';
            $html .= '<td>' . $row->no_order . '</td>';
            $html .= '<td class="text-center">' . date('d/m/Y', strtotime($row->created_at)) . '</td>';
            $html .= '<td>' . $row->nama_customer . '</td>';
            $html .= '<td>' . $row->nama_sales . '</td>';
            $html .= '<td class="text-right">Rp ' . number_format($row->total, 0, ',', '.') . '</td>';
            $html .= '<td class="text-center">' . ucfirst($row->status) . '</td>';
            $html .= '</tr>';
        }

        $html .= '<tr class="total-row">';
        $html .= '<td colspan="5" class="text-right">TOTAL</td>';
        $html .= '<td class="text-right">Rp ' . number_format($total_all, 0, ',', '.') . '</td>';
        $html .= '<td><td class="text-center"></td>'; // Perbaikan: kolom status untuk baris total
        $html .= '</tr>';
        $html .= '</tbody></table>';
        $html .= '<p style="margin-top:20px; font-size:10px; color:#888;">Dicetak pada: ' . date('d/m/Y H:i:s') . '</p>';
        $html .= '</body></html>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_penjualan_' . $date_from . '_' . $date_to . '.pdf', array('Attachment' => 0));
    }
}