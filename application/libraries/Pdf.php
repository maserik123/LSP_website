<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */

use Dompdf\Options;
use Dompdf\Dompdf;

class Pdf extends Dompdf
{
    /**
     * PDF filename
     * @var String
     */
    protected $ci;
    public $filename;

    public function __construct()
    {
        parent::__construct();
        $this->filename = "laporan.pdf";
        $this->ci = &get_instance();
    }

    public function setFileName($filename)
    {
        $this->filename = $filename;
    }
    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */


    protected function ci()
    {
        return get_instance();
    }
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */



    public function load_view($view, $data = array())
    {
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
        // Render the PDF
        $this->render();
        // Output the generated PDF to Browser
        $this->stream($this->filename, array("Attachment" => false));
    }

    public function loadView($viewFile, $data = array())
    {
        $options = new Options();
        $options->setChroot('/var/www/html/sistem_lsp');
        $options->setDefaultFont('courier');

        $this->setOptions($options);

        $html = $this->ci->load->view($viewFile, $data, true);
        $this->loadHtml($html);
        $this->render();
        $this->stream($this->filename, ['Attachment' => 0]);
    }
}
