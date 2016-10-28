<?php

namespace MigrationBundle\Command;

use LaFolleAgenceBundle\Entity\Category;
use LaFolleAgenceBundle\Entity\Comment;
use LaFolleAgenceBundle\Entity\LinkImage;
use LaFolleAgenceBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 26/10/16
 * Time: 12:44
 *
 */
class MigrateCommand extends ContainerAwareCommand
{
    private $connection;
    private $platform;
    private $output;

    protected function configure()
    {
        $this->setName('migration:run')
             ->setDescription('Migrate posts and comments from wordpress to lafolleagence')
             ->setHelp("Migrate posts and comments from wordpress to lafolleagence")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $doctrine = $this->getContainer()->get("doctrine");
        $targetManager = $doctrine->getManager("default");
        $this->connection = $targetManager->getConnection();
        $this->platform   = $this->connection->getDatabasePlatform();

        // category migration
        $this->truncate('category');
        $output->writeln("Importing Categories");
        $terms = $doctrine->getRepository('MigrationBundle:WpTerms', 'migration')->getCategories();
        $totalRecords = count($terms);
        $progress = new ProgressBar($output, $totalRecords);
        foreach($terms as $term){
            $category = new Category();
            $category->setCategoryName($term["name"]);
            $category->setId($term["termId"]);
            $targetManager->persist($category);
            $progress->advance();
        }
        $metadata = $targetManager->getClassMetaData(get_class($category));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $targetManager->flush();
        $progress->finish();
        $output->writeln("");
        $output->writeln("Importing Categories done");

        // posts migration
        $this->truncate('post');
        $this->truncate('posts_categorys');
        $output->writeln("Importing Posts");
        $posts = $doctrine->getRepository('MigrationBundle:WpPosts', 'migration')->getPosts();
        $totalRecords = count($posts);
        $progress = new ProgressBar($output, $totalRecords);
        foreach($posts as $post){
            //dump($post);die;
            $lfaPost = new Post();
            $lfaPost->setId($post->getId());
            $lfaPost->setContent($post->getPostContent());
            $lfaPost->setLink($post->getPostName());
            $lfaPost->setOpenComment(1);
            $lfaPost->setPublicationDate($post->getPostDate());
            $status = $post->getPostStatus();
            if ($status == "draft"){
                $lfaPost->setStatut(0);
            } else {
                $lfaPost->setStatut(1);
            }
            $lfaPost->setTitle($post->getPostTitle());
            $categories = $doctrine->getRepository('MigrationBundle:WpTermRelationships', 'migration')
                                   ->findBy(array('objectId' => $post->getId()));
            foreach ($categories as $category){
                $lfaCategory = $doctrine->getRepository('LaFolleAgenceBundle:Category', 'default')->find($category->getTermTaxonomyId());
                if (!is_null($lfaCategory)) {
                    $lfaPost->addCategory($lfaCategory);
                }
            }
            $targetManager->persist($lfaPost);
            $progress->advance();
        }
        $metadata = $targetManager->getClassMetaData(get_class($lfaPost));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $targetManager->flush();
        $progress->finish();
        $output->writeln("");
        $output->writeln("Importing Posts done");

        // comments migration
        $this->truncate('comment');
        $output->writeln("Importing Comment");
        $comments = $doctrine->getRepository('MigrationBundle:WpComments', 'migration')->getComments();
        $totalRecords = count($comments);
        $progress = new ProgressBar($output, $totalRecords);
        foreach($comments as $comment){
            $lfaComment = new Comment();
            $lfaComment->setId($comment->getCommentId());
            $lfaComment->setApproved("1");
            $lfaComment->setAuthor($comment->getCommentAuthor());
            $lfaComment->setAuthorEmail($comment->getCommentAuthorEmail());
            $lfaComment->setContent($comment->getCommentContent());
            $lfaComment->setDate($comment->getCommentDate());
            $post = $doctrine->getRepository('LaFolleAgenceBundle:Post', 'default')->find($comment->getCommentPostId());
            $lfaComment->setPost($post);
            $targetManager->persist($lfaComment);
            $progress->advance();
        }
        $metadata = $targetManager->getClassMetaData(get_class($lfaComment));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $targetManager->flush();
        $progress->finish();
        $output->writeln("");
        $output->writeln("Importing Comments done");

        // image gallery links migration
        $this->truncate('link_image');
        $output->writeln("Importing image gallery link");
        $links = $doctrine->getRepository('MigrationBundle:WpPosts', 'migration')->getImageLinks();
        $totalRecords = count($links);
        $progress = new ProgressBar($output, $totalRecords);
        foreach($links as $link){
            $imageLink = new LinkImage();
            $imageLink->setId($link->getId());
            $strLink = substr($link->getGuid(), 48);
            $imageLink->setPath($strLink);
            $targetManager->persist($imageLink);
            $progress->advance();
        }
        $metadata = $targetManager->getClassMetaData(get_class($imageLink));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $targetManager->flush();
        $progress->finish();
        $output->writeln("");
        $output->writeln("Importing image gallery link done");
    }

    private function truncate($table)
    {
        $this->output->writeln("Truncate $table");
        $this->connection->executeUpdate("SET FOREIGN_KEY_CHECKS=0;");
        $this->connection->executeUpdate($this->platform->getTruncateTableSQL($table, true));
        $this->connection->executeUpdate("SET FOREIGN_KEY_CHECKS=1;");
    }
}