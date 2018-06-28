<?php

namespace BigBridge\ProductImport\Model\Data;

/**
 * @author Patrick van Bergen
 */
class UrlRewrite
{
    /** @var int */
    protected $urlRewriteId;

    /** @var  string */
    protected $productId;

    /** @var  string */
    protected $requestPath;

    /** @var  string */
    protected $targetPath;

    /** @var  int 0 or 301 */
    protected $redirectType;

    /** @var  int|string */
    protected $storeId;

    /** @var  int|null */
    protected $categoryId;

    /** @var  int 0 or 1 */
    protected $autogenerated;

    /** @var bool Is there an entry in catalog_url_rewrite_product_category? */
    protected $extension;

    public function __construct($urlRewriteId, $productId, $requestPath, $targetPath, $redirectType, $storeId, $categoryId, $autogenerated, $hasExtension)
    {
        $this->urlRewriteId = (int)$urlRewriteId;
        $this->productId = (int)$productId;
        $this->requestPath = $requestPath;
        $this->targetPath = $targetPath;
        $this->redirectType = (int)$redirectType;
        $this->storeId = (int)$storeId;
        $this->categoryId = $categoryId === null ? null : (int)$categoryId;
        $this->autogenerated = (int)$autogenerated;
        $this->extension = (bool)$hasExtension;
    }

    public function equals(UrlRewrite $urlRewrite) {
        return (
            ($this->productId === $urlRewrite->productId) &&
            ($this->requestPath === $urlRewrite->requestPath) &&
            ($this->targetPath === $urlRewrite->targetPath) &&
            ($this->redirectType === $urlRewrite->redirectType) &&
            ($this->storeId === $urlRewrite->storeId) &&
            ($this->categoryId === $urlRewrite->categoryId) &&
            ($this->autogenerated === $urlRewrite->autogenerated) &&
            ($this->extension === $urlRewrite->extension)
        );
    }

    public function setUrlRewriteId(int $urRewriteId)
    {
        $this->urlRewriteId = $urRewriteId;
    }

    /**
     * @return int
     */
    public function getUrlRewriteId(): int
    {
        return $this->urlRewriteId;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getRequestPath(): string
    {
        return $this->requestPath;
    }

    /**
     * @return string
     */
    public function getTargetPath(): string
    {
        return $this->targetPath;
    }

    /**
     * @return int
     */
    public function getRedirectType(): int
    {
        return $this->redirectType;
    }

    /**
     * @return int|string
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @return int|null
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return int
     */
    public function getAutogenerated(): int
    {
        return $this->autogenerated;
    }

    public function hasExtension(): bool
    {
        return $this->extension;
    }

    public function getMetadata()
    {
        if ($this->categoryId === null) {
            if ($this->autogenerated) {
                return null;
            } else {
                return [];
            }
        } else {
            return ['category_id' => (string)$this->categoryId];
        }
    }

    public function getKey()
    {
        return implode('/', [
            $this->productId,
            $this->requestPath,
            $this->targetPath,
            $this->redirectType,
            $this->storeId,
            $this->categoryId,
            $this->autogenerated,
            $this->extension
        ]);
    }
}