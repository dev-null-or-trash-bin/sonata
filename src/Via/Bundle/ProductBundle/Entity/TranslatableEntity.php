<?php
namespace Via\Bundle\ProductBundle\Entity;

use Prezent\Doctrine\Translatable\Annotation as Prezent;
use Prezent\Doctrine\Translatable\Entity\AbstractTranslatable;

abstract class TranslatableEntity extends AbstractTranslatable
{
    /**
     * @Prezent\CurrentLocale
     */
    protected $currentLocale;

    /**
     * Cache current translation. Useful in Doctrine 2.4+
     */
    protected $currentTranslation;

    public function getCurrentLocale()
    {
        return $this->currentLocale;
    }

    public function setCurrentLocale($locale)
    {
        $this->currentLocale = $locale;
        return $this;
    }

    /**
     * Translation helper method
     */
    public function translate($locale = 'de')
    {
        if (null === $locale) {
            $locale = $this->currentLocale;
        }

        if (!$locale) {
            throw new \RuntimeException('No locale has been set and currentLocale is empty');
        }

        if ($this->currentTranslation && $this->currentTranslation->getLocale() === $locale) {
            return $this->currentTranslation;
        }

        if (!$translation = $this->translations->get($locale)) {            
            $translation = new $this->getTranslationEntityClass();
            $translation->setLocale($locale);
            $this->addTranslation($translation);
        }

        $this->currentTranslation = $translation;
        return $translation;
    }

    /**
     * Used for a2lix translations and the translate helper
     */
    abstract public function getTranslationEntityClass();
}