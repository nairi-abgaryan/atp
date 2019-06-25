<?php
namespace App\Controller;

use App\Entity\News;
use App\Manager\NewsManager;
use App\Service\Pagination\PaginationFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class NewsController
 * @Route("/{lang}")
 */
class NewsController extends AbstractController
{
    /**
     * @var NewsManager
     */
    private $newsManager;

    /**
     * @var TranslatorInterface $translator
     */
    private $translator;

    /**
     * @var PaginationFactory $paginationFactory
     */
    private $paginationFactory;

    /**
     * NewsController constructor.
     * @param NewsManager $newsManager
     * @param TranslatorInterface $translator
     * @param PaginationFactory $paginationFactory
     */
    public function __construct(
        NewsManager $newsManager,
        TranslatorInterface $translator,
        PaginationFactory $paginationFactory
    ) {
        $this->newsManager = $newsManager;
        $this->translator = $translator;
        $this->paginationFactory = $paginationFactory;
    }

    /**
     * Get News
     *
     * @Route("/news/{id}", methods={"GET"}, name="app.get_news", requirements={"id"="\d+"})
     * @param News $news
     * @return mixed
     */
    public function retrieve(News $news)
    {
        return $this->render("index/single-news.html.twig", [
            "news" => $news
        ]);
    }

    /**
     * Get News
     *
     * @Route("/news", methods={"GET"}, name="app.get_news_collection")
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $newsQb = $this->newsManager->findList();
        $paginatedNews = $this->paginationFactory->pager($newsQb, $request);

        return $this->render("index/news.html.twig", [
            "pager" => $paginatedNews
        ]);
    }
}
