# Imgix for MODX

Create Imgix URLs similar to pThumb.

## Setup

Configure the `imgix.urls` setting to point to your imgix URL. Multiple URLs are supported for sharding seperated by two pipes "||".

## Examples

### Output Filter

Assuming img is a placeholder with an absolute or relative image URL.

```[[+img:imgix=`w=500`]]```

### Snippet

```[[imgix? &input=`https://example.imgix.net/some/path/to/image.png` &options=`h=100`]]```

## Development

Clone the repository and run `composer install` in `core/components/imgix` to download the dependencies.