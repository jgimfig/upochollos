package persistencia;

import java.util.ArrayList;
import java.util.List;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import pojos.Producto;
import pojos.Puntua;
import pojos.Usuario;

public class PuntuaDAO implements RelacionDAO<Producto, Usuario, Integer>{

    private Session sesion = null;
    
    @Override
    public Integer getAttribute(Producto elemento1, Usuario elemento2) {
        
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Puntua where id_producto='"+elemento1.getId()+"' and nombre_usuario='"+elemento2.getUsuario()+"'");
            tx.commit();
            return ((Puntua)query.uniqueResult()).getPuntuacion();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
        
    }

    @Override
    public List<Producto> getElemento1(Usuario elemento2) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        List<Puntua> listaPuntua = new ArrayList<>();
        List<Producto> listaProductos = new ArrayList<>();
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Puntua where nombre_usuario='"+elemento2.getUsuario()+"'");
            listaPuntua = query.list();
            for(int i = 0; i < listaPuntua.size(); i++){
                listaProductos.add(listaPuntua.get(i).getProducto());
            }
            
            tx.commit();
            return listaProductos;
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Usuario> getElemento2(Producto elemento1) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        List<Puntua> listaPuntua = new ArrayList<>();
        List<Usuario> listaUsuarios = new ArrayList<>();
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Puntua where id_producto='"+elemento1.getId()+"'");
            listaPuntua = query.list();
            
            for(int i = 0; i < listaPuntua.size(); i++){
                listaUsuarios.add(listaPuntua.get(i).getUsuario());
            }
            
            tx.commit();
            return listaUsuarios;
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }
    
    //DADA UNA PUNTUACIÓN, LA ALMACENA EN LA BASE DE DATOS
    public void create(Puntua elemento) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("delete from Puntua where id_producto='"+elemento.getProducto().getId()+"' and usuario = '"+elemento.getUsuario().getUsuario()+"'");
            query.executeUpdate();
            sesion.save(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }
    
}
