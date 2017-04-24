

function [n]=get_prediction(x,a)

%% @brief  Routine to classify a new data sample using the SVM algorithm 
%%         trained with 'train_svm_class'.
%%
     dtest = data(x);
     rtest = test(a, dtest);

     i = 1;
     while( rtest.X(1,i) == -1 )
          i = i + 1;
     end
     n = i;

     clear dtest rtest i
end
