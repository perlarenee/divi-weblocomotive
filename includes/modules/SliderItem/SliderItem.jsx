// External Dependencies
import React, { Component ,Fragment} from 'react';

class SliderItem extends Component {
  static slug = 'et_pb_diwe_slider_item';
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
      <Fragment>
        {this._renderTitle()}
        {this._renderContent()}
      </Fragment>
    )
  };

  
  
  render() {
    const props = this.props;
    const myComponentStyle = {
      backgroundImage: "url("+props['upload']+")",
      color: props['color'],
      backgroundColor: props['background']
   }
   const descComponentStyle = {
    backgroundColor: props['background_desc']
   }
   let descHeight = "center_h";
   let descWidth = "center_h";
   let classes = "image";
   if(props.height_desc === undefined || props.height_desc === "on"){
    classes += " fullHeight";
    }
    if(props.width_desc === undefined || props.width_desc === "on"){
      classes += " fullWidth";
    }
    if(props.position_height_desc !== undefined){
      descHeight = props.position_height_desc;
    }
    if(props.position_width_desc !== undefined){
      descWidth = props.position_width_desc;
    }
    classes += ' ' + descHeight + ' ' + descWidth;
   
    return (
      <Fragment>
          <div className={classes} style={myComponentStyle}><div className="description" style={descComponentStyle}><div className="inner">
          {this._renderDesc()}
          </div> </div></div>
      </Fragment>
    )
  };

};
export default SliderItem;