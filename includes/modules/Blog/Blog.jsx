// External Dependencies
import React, { Component ,Fragment} from 'react';

// Internal Dependencies
import './style.css';


class Blog extends Component {

  static slug = 'et_pb_diwe_blog';

  state = {
    blog: []
  }

  componentDidMount() {
    let postType = this.props.post_type;
    let path = "/wp-json/wp/v2/posts?post_type="+postType+'&_embed';
    if (window.location.hostname === "localhost" || window.location.hostname === "127.0.0.1" || window.location.hostname === ""){
      path = '?rest_route=/wp/v2/posts&post_type='+postType+'&_embed';
    }

    fetch(path)//'http://weblocomotive.com/wp-json/wp/v2/posts?post_type=post')
    .then((response) => response.json())
    .then(allPosts => {
        this.setState({ blog: allPosts });
    })
    .catch(error => console.log('Error:', error));

  }

  _imageRender(data){
    let img = "";
    if(data._embedded['wp:featuredmedia']){
      img = <div className="photo hello" style={{backgroundImage:"url("+data._embedded['wp:featuredmedia'][0].source_url+")"}}></div>
    }
    return img;
  }

  _tagsList(data){
    let tags = data.tags;
    let termData = data._embedded['wp:term'][1];
    let tagList = "";
    tags.forEach(function(val){
      termData.forEach(function(term){
        let id = term.id;
        let link = term.link;
        let name = term.name;
        if(id===val){
          if(tagList!==""){
            tagList += "|";
          }
          tagList += '<a href='+link+'>'+name+'</a> ';
        }
      });
    });

    return tagList;
  }

  _cat(data){
    let catData = data._embedded['wp:term'][0][0];
    let catFirst = "";
    if(catData && catData.name !== "Uncategorized"){
      catFirst = catData.name;
    }
    return catFirst;
  }

  _renderSubTitle(post){
    let code = this.props.code === "on" ? true : false;
    //let dark = this.props.dark === "on" ? true : false;
    let subTitle = '';
    if(this._cat(post) && this._cat(post) !== ""){
      subTitle = <h2>{code ? <span class="code">&lt;H2&gt;</span> : ''}{this._cat(post)}{code ? <span class="code">&lt;/H2&gt;</span> : ''}</h2>
    }
    return subTitle;
  }

  _renderPost(post){
    let code = this.props.code === "on" ? true : false;
    let dark = this.props.dark === "on" ? true : false;
    return (
      <div className={`blog-card ${dark ? 'dark' : ''} ${code ? 'code' : ''}`}>
        <div class="meta">
        {this._imageRender(post)} 
        <ul class="details"><li class="author"><a href={post._embedded['author'][0].link}>{post._embedded['author'][0].name}</a></li><li class="tags" dangerouslySetInnerHTML={{__html: this._tagsList(post)}}/></ul>
        </div>
        <div class="description">
        <h1>{code ? <span class="code">&lt;H1&gt;</span> : ''}{post.title.rendered}{code ? <span class="code">&lt;/H1&gt;</span> : ''}</h1>
        {this._renderSubTitle(post)}
        <div dangerouslySetInnerHTML={{__html: post.excerpt.rendered}}/>
        <p class="readmore"><a className="readmore" href={post.link}>{code ? <span class="code">&lt;a&gt;</span> : ''}Read More{code ? <span class="code">&lt;/a&gt;</span> : ''}</a></p>
        </div>
      </div>
    )
  }

  render() {
    return (
      <Fragment>
        <h1 className="blog-heading">{this.props.heading}</h1>
        <p>{this.props.content()}</p>
        <div className="diwe-blog">
          {this.state.blog.map((post) => (
            this._renderPost(post)
           ))}
       </div>
      </Fragment>
    );
  }
}

export default Blog;