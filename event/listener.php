<?php
/**
 * @package mundophpbb/simpledown
 * @copyright (c) 2025 Mundo phpBB
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License, version 2.
 */
namespace mundophpbb\simpledown\event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class listener implements EventSubscriberInterface
{
    protected $template;
    protected $helper;
    protected $language;
    /**
     * Construtor
     *
     * @param \phpbb\template\template $template Template object
     * @param \phpbb\controller\helper $helper Controller helper object
     * @param \phpbb\language\language $language Language object
     */
    public function __construct(\phpbb\template\template $template, \phpbb\controller\helper $helper, \phpbb\language\language $language)
    {
        $this->template = $template;
        $this->helper = $helper;
        $this->language = $language;
    }
    /**
     * Retorna os eventos escutados por este listener.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'core.page_header' => 'add_page_header_link',
        );
    }
    /**
     * Adiciona um link para a página de Downloads no cabeçalho do fórum.
     */
    public function add_page_header_link()
    {
        $this->language->add_lang('common', 'mundophpbb/simpledown');
        $this->template->assign_vars(array(
            'U_SIMPLEDOWN' => $this->helper->route('mundophpbb_simpledown_index'),
        ));
    }
}