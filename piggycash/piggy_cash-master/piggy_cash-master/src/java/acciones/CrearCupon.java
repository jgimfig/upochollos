package acciones;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.CuponDAO;
import pojos.Cupon;

public class CrearCupon extends ActionSupport implements SessionAware {

    public String nombreCupon, codigoCupon, fechaPubCupon, fechaVencCupon, descCupon, cupon_id;

    Map<String, Object> SESION;

    public CrearCupon() {
    }

    public String getNombreCupon() {
        return nombreCupon;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setNombreCupon(String nombreCupon) {
        this.nombreCupon = nombreCupon;
    }

    public String getCodigoCupon() {
        return codigoCupon;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setCodigoCupon(String codigoCupon) {
        this.codigoCupon = codigoCupon;
    }

    public String getFechaPubCupon() {
        return fechaPubCupon;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setFechaPubCupon(String fechaPubCupon) {
        this.fechaPubCupon = fechaPubCupon;
    }

    public String getFechaVencCupon() {
        return fechaVencCupon;
    }

    public void setFechaVencCupon(String fechaVencCupon) {
        this.fechaVencCupon = fechaVencCupon;
    }

    public String getDescCupon() {
        return descCupon;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setDescCupon(String descCupon) {
        this.descCupon = descCupon;
    }

    public String getCupon_id() {
        return cupon_id;
    }

    public void setCupon_id(String cupon_id) {
        this.cupon_id = cupon_id;
    }

    @Override
    public void validate() {

        try {
            new SimpleDateFormat("dd/MM/yyyy").parse(getFechaPubCupon());
        } catch (Exception ex) {
            addFieldError("fechaPubCupon", getText("formato.fecha"));
        }
        
        try {
            new SimpleDateFormat("dd/MM/yyyy").parse(getFechaVencCupon());
        } catch (Exception ex) {
            addFieldError("fechaVencCupon", getText("formato.fecha"));
        }
        
        try{
           Date fp = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaPubCupon());
           Date fv = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaVencCupon());
           
           if (fp.after(fv)){
                addFieldError("fechaVencCupon", getText("viaje.en.el.tiempo"));
           }
           
        }catch(Exception e){
            
        }

    }

    @Override
    public String execute() throws Exception {

        Date fechaPub = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaPubCupon());
        Date fechaVenc = new SimpleDateFormat("dd/MM/yyyy").parse(getFechaVencCupon());

        Cupon cupon = new Cupon(getNombreCupon(), getCodigoCupon(), fechaPub, fechaVenc, getDescCupon());

        
        //Si existe se actualiza
        if (getCupon_id() == null || getCupon_id().length() <= 0) {
            new CuponDAO().create(cupon);
        } else {
            cupon.setId(Integer.parseInt(getCupon_id()));
            new CuponDAO().update(cupon);
        }

        getSESION().put("CUPONES", new CuponDAO().list());

        setCupon_id(""); // Se resetea el ID al volver a la página. Para poder gestionar otros cupones sin cambiar los datos sin querer

        return SUCCESS;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

}
