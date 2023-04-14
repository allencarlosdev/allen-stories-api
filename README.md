# API REST - allen-stories

### Introduction

This API was built in Laravel with the goal of displaying information about some stories for children.

This api is completely public and was created to be consumed by the following application https://allen-stories.netlify.app/

#### Get all items

```http
get https://api-allen-stories.000webhostapp.com/api/stories
```

| Parameter | Type     | Description                     |
| :-------- | :------- | :------------------------------ |
| `api_key` | `string` | **Not Required - It's public**. |

#### Get item

```http
get  https://api-allen-stories.000webhostapp.com/api/stories/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

## The post, patch and delete methods are available.

But we recommend not touching these methods, so that there is always information in the API. In any case, we always update the database once a month to restore the default information.

#### Post item

```https
post  https://api-allen-stories.000webhostapp.com/api/stories
```

#### Put item

```http
put  https://api-allen-stories.000webhostapp.com/api/stories/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

#### Delete item

```http
Del  https://api-allen-stories.000webhostapp.com/api/stories/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

## Example of an application that consumes this API

https://allen-stories.netlify.app/
