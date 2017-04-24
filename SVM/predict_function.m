%% This fuction is to get the result of SVM prediction.

function predict_function(price_data, svm_model, name)

     I = 4;
     prediction = zeros(1, I);

     [row,column] = size(price_data);
     
     for i=1:row
     index = get_prediction(price_data(i,:), svm_model); 
     prediction(index) = prediction(index) + 1;
     end
     
     result = max(prediction);
     
     for i=1:I
         if( prediction(i) == result )
             %fprintf(1, '\nclass %d\n', i );
             result_index = i;
             break
         end
     end
     
     
     if (result_index == 1)
        'Predicted Pattern => Cup and Saucer' 
        suggestion = 'UP';
        pattern = 'Cup and Saucer';
     elseif (result_index == 2) 
        'Predicted Pattern => Ascending triangle'
        suggestion = 'UP';
        pattern = 'Ascending triangle';
     elseif (result_index ==3) 
        'Predicted Pattern => Descending triangle'
        suggestion = 'DOWN'
        pattern = 'Descending triangle';
     elseif (result_index ==4)   
        'Predicted Pattern => Head and Shoulders'
        suggestion = 'DOWN'
        pattern = 'Head and Shoulders';
     end
    
     %result1 = horzcat(suggestion,pattern);
     %dlmwrite('decision.txt', result1,'-append'); %%Writing the result to a file
     fp=fopen('A.txt','a');
     fprintf(fp,'%s,%s\n',suggestion,pattern);
     fclose(fp);
     clear all;
end
