package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.AnuncioDAO;
import persistencia.CategoriaDAO;
import persistencia.CuponDAO;
import persistencia.PatrocinadorDAO;
import persistencia.TiendaDAO;
import pojos.Usuario;

public class IrAPagina extends ActionSupport implements SessionAware {

    Map<String, Object> SESION;

    private String accionAEjecutar;

    public String getAccionAEjecutar() {
        return accionAEjecutar;
    }

    public void setAccionAEjecutar(String accionAEjecutar) {
        this.accionAEjecutar = accionAEjecutar;
    }

    public IrAPagina() {
    }

    @Override
    public String execute() throws Exception {

        clearSession();

        switch (accionAEjecutar) {
            case "chollos":
                return "chollos";
            case "cupones":
                return "cupones";
            case "cerrarSesion":
                getSESION().clear();
                return "cerrarSesion";
                
            case "fotoPerfil":
                if (getSESION().get("USUARIO") != null) {
                    return "perfil";
                } else {
                    return "iniciarSesion";
                }
            case "adminCategorias":
                if (isAdmin()) {
                    getSESION().put("CATEGORIAS", new CategoriaDAO().list());
                    return "adminCategorias";
                }
            case "adminTiendas":
                if (isAdmin()) {
                    getSESION().put("TIENDAS", new TiendaDAO().list());
                    return "adminTiendas";
                }
            case "adminCupones":
                if (isAdmin()) {
                    getSESION().put("CUPONES", new CuponDAO().list());
                    return "adminCupones";
                }
            case "adminAnuncios":
                if (isAdmin()) {
                    getSESION().put("ANUNCIOS", new AnuncioDAO().list());
                    getSESION().put("PATROCINADORES", new PatrocinadorDAO().list());
                    return "adminAnuncios";
                }
            case "registrar":
                return "registrar";
        }

        return ERROR;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }

    public void clearSession() {
        getSESION().remove("CATEGORIAS");
        getSESION().remove("TIENDAS");
        getSESION().remove("CUPONES");
        getSESION().remove("ANUNCIOS");
        getSESION().remove("PATROCINADORES");
    }

    public boolean isAdmin() {
        Usuario us = (Usuario) getSESION().get("USUARIO");
        if (us == null) {
            return false;
        }
        return us.getTipo().equalsIgnoreCase("admin");
    }

}
