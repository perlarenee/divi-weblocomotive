// External Dependencies
import React, { Component ,Fragment} from 'react';

class MasonryGridItem extends Component {
  static slug = 'et_pb_diwe_masonry_grid_item';
  _renderTitle(){
    const props = this.props;
    if(! props.heading){
      return false;
    }
    return (
      <h4>{props.heading}</h4>
    )
  };
  _renderContent(){
    const props = this.props;
    if(!props.content().props.content){
      return false;
    }
    return (
      <Fragment>
        {props.content()}
      </Fragment>
    )
  };
  _renderDesc(){
    const props = this.props;
    if(! props.heading && !props.content().props.content){
      return false;
    }
    return (
      <div className="description"><div className="inner">
        {this._renderTitle()}
        {this._renderContent()}
      </div></div>
    )
  };
  
  render() {
    const props = this.props;
    return (
      <Fragment>
          <img src={props.upload} alt="" />
          {this._renderDesc()}
      </Fragment>
    )
  };

};
export default MasonryGridItem;